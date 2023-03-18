<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): OrderCollection
    {
        return new OrderCollection(
            Order::when(request('status'), function($query){
                $query->where('status', 'like', '%'.request('status').'%');
            })->with('table')->paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $data = request()->json()->all();
        $order = Order::create(
            [
                'table_id'=> $data['table_id'],
                'status' => 'Pending'
            ]
        );
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'order' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        $order->load(['table','menu_items','tenant']);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $data = request()->json()->all();
        $order->status = $data['status'];
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Order Updated successfully',
            'order' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): Response
    {
        $order->delete();
        return response()->noContent();
    }
}
