<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\MenuItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
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
        $menu_items= [];
        $now = Carbon::now('utc')->toDateTimeString();

        $order = Order::findOrFail($data['order_id']);

        foreach ($data['menu_items'] as $item){
            $menu_items[] = [
                'order_id' => $data['order_id'],
                'menu_item_id' => $item['menu_item']['id'],
                'qty' => $item['qty'],
                'tenant_id' => request()->header('X-TENANT_ID'),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        OrderItem::insert($menu_items);

        return response()->json([
            'status' => 'success',
            'message' => 'Order Created successfully',
            'order' => new OrderResource($order)
        ], 200);
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
