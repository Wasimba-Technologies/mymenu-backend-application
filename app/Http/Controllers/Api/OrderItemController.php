<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItemRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->json()->all();

        $order_item = new OrderItem;

        foreach ($data['menu_items'] as $item){
            $order_item->order_id = $data['order_id'];
            $order_item->menu_item_id = $item->menu_item->id;
            $order_item->qty = $item->qty;
            $order_item->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
