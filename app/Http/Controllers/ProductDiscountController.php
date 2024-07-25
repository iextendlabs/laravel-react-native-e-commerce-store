<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDiscountRequest;
use App\Models\Product;
use App\Models\ProductDiscount;
use Illuminate\Http\Request;

class ProductDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_discount = ProductDiscount::all();
        return view('product_discount.index', compact('product_discount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('product_discount.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductDiscountRequest $request)
    {
        $data = $request->all();
        ProductDiscount::create($data);
        return to_route('product-discount.index');
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
    public function edit(ProductDiscount $product_discount)
    {
        $products = Product::all();
        return view('product_discount.edit', compact('product_discount', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductDiscountRequest $request, ProductDiscount $product_discount)
    {
        $data = $request->all();
        $product_discount->update($data);
        return to_route('product-discount.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDiscount $product_discount)
    {
        $product_discount->delete();
        return back();
    }
}
