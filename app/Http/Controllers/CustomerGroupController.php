<?php

namespace App\Http\Controllers;

use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_group = CustomerGroup::all();
        return view('customer_group.index', compact('customer_group'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer_group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data  = $request->validate([
            'name' => 'required|min:3'
        ]);

        CustomerGroup::create($data);
        return to_route('customer-group.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerGroup $customer_group)
    {
        return view('customer_group.edit', compact('customer_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerGroup $customer_group)
    {
        $data  = $request->validate([
            'name' => 'required|min:3'
        ]);

        $customer_group->update($data);
        return to_route('customer-group.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerGroup $customer_group)
    {
        $customer_group->delete();
        return redirect()->back();
    }
}
