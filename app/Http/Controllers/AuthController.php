<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
        return view('auth.register');
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
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
