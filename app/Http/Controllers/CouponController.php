<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\CustomerGroup;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupon = Coupon::all();
        return view('coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer_group = CustomerGroup::all();
        $products = Product::all();
        $category = Category::all();
        return view('coupon.create', compact('products', 'category', 'customer_group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $coupon = Coupon::create($data);
        return to_route('coupons.index');
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
    public function edit(Coupon $coupon)
    {
        $product = Product::all();
        $category = Category::all();
        $customer_group = CustomerGroup::all();
        $category_ids = $coupon->category()->pluck('category_id')->toArray();
        $product_ids = $coupon->product()->pluck('product_id')->toArray();
        return view('coupon.edit', compact('coupon', 'product', 'category', 'category_ids', 'product_ids', 'customer_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Coupon $coupon, CouponRequest $request)
    {
       

        $data = $request->only('name', 'code', 'type', 'discount', 'status', 'start_date', 'end_date', 'customer_groups_id');
        $coupon->category()->sync($request->category_id);
        $coupon->product()->sync($request->product_id);
        $coupon->update($data);
        return to_route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function coupon_history(string $id)
    {
        $coupon_history = CouponHistory::find($id);
        $order = Order::where('id', $coupon_history->order_id)->get()->first();
        // dd($order);
        return view('coupon.coupon_detail', compact('coupon_history'));
    }
}
