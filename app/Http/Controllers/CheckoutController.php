<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTotal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function cart(Request $request)
    {
        $subtotal = 0;
        $coupon = Coupon::where('code', $request->code)->get()->first();
        $cart = session('cart', []);
        $coupon_data = session('coupon', []);
        if (
            $coupon && $coupon->status === 'enable' &&
            strtotime($coupon->start_date) <= strtotime(date('Y-m-d')) &&
            strtotime($coupon->end_date) >= strtotime(date('Y-m-d'))
        ) {
            session()->put('coupon', $coupon);
        } elseif ($request->code) {
            session()->forget('coupon');
            flash()->addInfo('coupon in invalid');
        } else {
            session()->forget('coupon');
        }
        $products = [];
        foreach ($cart as $key => $value) {
            if (array_key_exists($key, $cart)) {
                $product = Product::find($key);
                if ($product) {
                    $product['quantity'] = $value['quantity'];
                    $products[] = $product;
                }
            }
        }
        return view('checkout.cart', compact('products', 'coupon', 'coupon_data'));
    }

    public function add_to_cart(string $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cartItem['quantity'] = 1;
            $cart[$id] = $cartItem;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function buy_now(string $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cartItem['quantity'] = 1;
            $cart[$id] = $cartItem;
        }
        session()->put('cart', $cart);
        $products = [];
        if (auth()->user()) {
            foreach ($cart as $key => $value) {
                $product = Product::find($key);
                $product['quantity'] = $value['quantity'];
                $products[] = $product;
            }
            $address = CustomerAddress::all();
            return view('checkout.checkout', compact('address', 'products'));
        }
        return back();
    }

    public function remove(string $id)
    {
        $cartItems = session('cart', []);


        if (isset($cartItems[$id])) {

            unset($cartItems[$id]);
            session(['cart' => $cartItems]);

            return redirect()->back();;
        } else {
            return redirect()->back();;
        }
    }

    public function quantity(Request $request, string $id)
    {
        $cartItems = session('cart', []);
        $product = Product::find($id);
        if ($product->quantity >= $request->quantity) {
            if (isset($cartItems[$id])) {
                $cartItems[$id]['quantity'] = $request->quantity;
            }
        } else {
            flash()->addWarning('quantity no available');
        }
        session()->put('cart', $cartItems);
        return back();
    }

    public function checkout(Request $request)
    {

        $cart = session()->get('cart', []);
        $coupon_data = session()->get('coupon', []);
        // dd($coupon_data);
        $products = [];
        if (auth()->user()) {
            foreach ($cart as $key => $value) {
                $product = Product::find($key);
                $product['quantity'] = $value['quantity'];
                $products[] = $product;
            }
            $address = CustomerAddress::all();
            return view('checkout.checkout', compact('address', 'products', 'coupon_data'));
        }
        return back();
    }

    public function place_order(Request $request)
    {
        $cartItems = session('cart', []);
        $coupon = session('coupon', []);
        $subtotal = 0;
        $total = 0;
        $final = 0;
        $discount = 0;

        if ($request->country) {
            $data  = $request->all();
            $data['user_id'] = Auth::id();
            $address =  CustomerAddress::create($data);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_address_id' => $request->address ? $request->address : $address->id
        ]);

        foreach ($cartItems as $key => $value) {
            $product = Product::find($key);
            $quantity = $product->quantity - $value['quantity'];
            $product->quantity = $quantity;
            $product->save();
            $subtotal += $product->price * $value['quantity'];
            if ($coupon && $coupon->type === 'fixed amount') {
                $final = $coupon->discount;
                $total = ($subtotal + $discount) - $final;
            } else if ($coupon && $coupon->type === 'percentage') {
                $final = ($subtotal + $discount) * ($coupon->discount) / 100;
                $total = ($subtotal + $discount) - $final;
            } else {
                $total = $subtotal + $discount;
            }
            $order_product = OrderProduct::create([
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $value['quantity'],
                'product_id' => $product->id,
                'total' => $product->price * $value['quantity'],
                'order_id' => $order->id
            ]);
        }

        $order_total = OrderTotal::create([
            'total' => $total,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'order_id' => $order->id
        ]);
        // dd($total);
        if ($coupon) {
            $coupon_history = CouponHistory::create([
                'discount_amount' => $final,
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'coupon_id' => $coupon->id,
            ]);
        }
        session()->forget('cart');
        return to_route('dashboard');
    }

    public function my_orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('checkout.my_order', compact('orders'));
    }

    public function order_detail(string $id)
    {
        $orderProduct = OrderProduct::where('order_id', $id)->latest()->get();
        $orders = Order::find($id);
        return view('checkout.order_detail', compact('orderProduct', 'orders'));
    }
}
