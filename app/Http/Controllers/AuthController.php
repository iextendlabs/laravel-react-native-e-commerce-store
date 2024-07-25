<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\CustomerGroup;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        $product = Product::simplePaginate(11);;
        return view('dashboard', compact('product'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $customer_group = CustomerGroup::all();
        return view('auth.register', compact('customer_group'));
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function store_register(RegisterRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    public function store_login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if (Auth::user()->admin === 1) {
            return redirect()->route('admin.dashboard');
        } 
        return redirect()->intended(RouteServiceProvider::HOME);
        

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
