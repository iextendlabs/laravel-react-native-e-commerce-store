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
        return view('checkout.cart');
    }

    public function add_to_cart(string $id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cartItem = $product->toArray();
            $cartItem['quantity'] = 1;
            $cart[$id] = $cartItem;
        }

        $total = 0;
        foreach ($cart as $item) {
            if (isset($item['price'])) {
                $total += $item['quantity'] * $item['price'];
            }
        }
        session()->put('cart_total', $total);
        session()->put('cart', $cart);

        return redirect()->back();
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

        if (isset($cartItems[$id])) {
            $cartItems[$id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cartItems);
        return back();
    }

    public function checkout(Request $request)
    {
        if (auth()->user()) {
            $address = CustomerAddress::all();
        return view('checkout.checkout', compact('address'));
        }
        return back();
    }

    public function place_order(Request $request)
    {
        // dd($request->all());
        $cartItems = session('cart', []);
        $subtotal = 0;
        $discount = 0;

        if ($request->country) {
            $data  = $request->all();
            $data['user_id'] = Auth::id();
            $address =  CustomerAddress::create($data);
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_address_id' => $address ? $address->id : $request->address
        ]);
        // $product = Product::find();
            
        // dd($product);

        foreach ($cartItems as $key => $value) {
            $subtotal += $value['price'] * $value['quantity'];
            $total = $discount + $subtotal;

            $order_product = OrderProduct::create([
                'name' => $value['name'],
                'price' => $value['price'],
                'quantity' => $value['quantity'],
                'product_id' => $value['id'],
                'total' => $value['price'] * $value['quantity'],
                // 'order_id' => $order->id
            ]);
        }

        $order_total = OrderTotal::create([
            'total' => $total,
            'subtotal' => $subtotal,
            'discount' => $discount,
            // 'order_id' => $order->id
        ]);
        session()->forget('cart');
        return redirect()->route('/');
    }
}
