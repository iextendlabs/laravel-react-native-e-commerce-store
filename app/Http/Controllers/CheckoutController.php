<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTotal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function cart()
    {
        $cart = session('cart', []);
        $products = [];
        foreach ($cart as $key => $value) {
            $product = Product::find($key);
            $product['quantity'] = $value['quantity'];
            $products[] = $product;
        }
        return view('checkout.cart', compact('products'));
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
        // dd($cart);
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
        $cart = session('cart', []);
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

    public function place_order(Request $request)
    {
        $cartItems = session('cart', []);
        $subtotal = 0;
        $discount = 0;
        // dd($cartItems);
        // dd($request->all());

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
            // dd($product->price * $value['quantity']);
            $quantity = $product->quantity - $value['quantity'];
            $product->quantity = $quantity;
            $product->save();
            $subtotal += $product->price * $value['quantity'];
            $total = $discount + $subtotal;
            $order_product = OrderProduct::create([
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $value['quantity'],
                'product_id' => $product->id,
                'total' => $product->price * $value['quantity'],
                'order_id' => $order->id
            ]);
        }
        // dd($total);

        $order_total = OrderTotal::create([
            'total' => $total,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'order_id' => $order->id
        ]);
        session()->forget('cart');
        return to_route('dashboard');
    }

    public function my_orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        // dd($orders->order_products->name);
        return view('checkout.my_order', compact('orders'));
    }

    public function order_detail(string $id)
    {
        $orderProduct = OrderProduct::where('order_id', $id)->latest()->get();
        $orders = Order::find($id);
        // dd($orders);   
        return view('checkout.order_detail', compact('orderProduct', 'orders'));
    }
}
