<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): OrderCollection
    {
        $this->authorize('viewAny', Order::class);
        return new OrderCollection(
            Order::with(['menu_items','table'])
            ->when(request('status'), function($query){
                $query->where('status', 'like', '%'.request('status').'%');
            })
            ->when(request('start_date'), function ($query) {
                $query->whereBetween('created_at', [request('start_date'), request('end_date')]);
            })
            ->with('table')
            ->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //$this->authorize('create', Order::class);
        $data = $request->validated();
        $total_orders = Order::count();
        $tenant = Restaurant::withoutGlobalScope(TenantScope::class )
            ->with('plan')
            ->findOrFail($request->header('X-TENANT-ID'));
        if($total_orders < $tenant->plan->orders) {
            $data['customer_id'] = $request->user()->id;
            $order_items = $data['menu_items'];
            unset($data['menu_items']);
            $order = Order::create($data);
            $order->menu_items()->attach($order_items);
            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully',
                'order' => $order
            ]);
        }
        return response()->json([
            'status'=> 'failure',
            'message'=> "Maximum orders in your plan reached"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        $this->authorize('view', $order);
        $order->load(['table','menu_items','tenant']);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);
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
        $this->authorize('delete', $order);
        $order->delete();
        return response()->noContent();
    }
}
