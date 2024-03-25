<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cart()
    {
        return view('checkout.cart');
    }

    public function add_to_cart(string $id, )
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Clone the product instance
            $cartItem = $product->toArray();
            $cartItem['quantity'] = 1;
            $cart[$id] = $cartItem;
        }

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

    public function checkout(Request $request)
    {
        return view('checkout.checkout');
    }

    public function quantity(Request $request , string $id)
    {
        $cartItems = session('cart', []);
        
        if (isset($cartItems[$id])) {
            $cartItems[$id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cartItems);
        return back();

    }
}
