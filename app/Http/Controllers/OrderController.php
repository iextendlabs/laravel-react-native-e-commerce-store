<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderProduct = OrderProduct::all();
        return view('order.index', compact('orderProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(String $id)
    {
        $orderProduct = OrderProduct::find($id);
        return view('order.edit', compact('orderProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $orderProduct = OrderProduct::find($id);
        $orderProduct->update($data);
        $orderProduct->order->status = $request->status;
        $orderProduct->save();
        $orderProduct->order->save();
        return to_route('orders');
    }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderProduct = OrderProduct::find($id);
        $orderProduct->delete();
        $orderProduct->order->delete();
        $orderProduct->order->order_total->delete();
        return to_route('orders');
    }
}
