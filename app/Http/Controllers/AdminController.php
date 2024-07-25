<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        if (Auth::user()->admin === 1) {
            return view('admin.dashboard');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_profile(CustomerRequest $request, string $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->update($data);

        return to_route('admin.dashboard');
    }
}
