<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\MenuItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderMenuItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class OrderMenuItemController extends Controller
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
        $order = Order::findOrFail($data['order_id']);
        foreach ($data['menu_items'] as $item){
            $order->menu_items()->attach(
                $item['menu_item']['id'],
                ['qty' => $item['qty']]
            );
        }

        //OrderMenuItem::insert($menu_items);

        return response()->json([
            'status' => 'success',
            'message' => 'Order Created successfully',
            'order' => new OrderResource($order)
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderMenuItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderMenuItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderMenuItem $orderItem)
    {
        //
    }
}
