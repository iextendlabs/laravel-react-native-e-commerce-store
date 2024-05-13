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
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $query = Order::query()
            ->when($request->status, fn ($query) => $query->where('status', $request->status))
            ->when($request->date, fn ($query) => $query->whereDate('created_at', $request->date))
            ->when($request->name)->whereHas('user', fn ($query) => $query->where('name', $request->name))
            ->orderBy($sort, $direction);
        $count = $query->count();
        $orderProduct = $query->simplePaginate(10);
        return view('order.index', compact('orderProduct', 'count', 'direction'));
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
        if ($orderProduct) {
            $order = $orderProduct->order;
            if ($order) {
                $orderTotal = $order->order_total;
                if ($orderTotal) {
                    $orderTotal->delete();
                }
                $order->delete();
            }
            $orderProduct->delete();
        }
        return to_route('orders');
    }


    public function order_detail(string $id)
    {
        $orderProduct = OrderProduct::where('order_id', $id)->latest()->get();
        $orders = Order::find($id);;
        return view('order.order_detail', compact('orderProduct', 'orders'));
    }
}
