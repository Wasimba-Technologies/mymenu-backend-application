<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): UserResource | JsonResponse
    {
        $orders = Order::all();
        $tenant_id = $request->header('X-TENANT-ID');
        $tenant = Restaurant::withoutGlobalScope(TenantScope::class)->with('plan')->findOrFail($tenant_id);
        if(count($orders) < $tenant->plan->users) {
            $data = $request->validated();
            $user = User::create($data);
            return new UserResource($user);
        }
        return response()->json([
            'status'=> 'failure',
            'message'=> "Maximum users in your plan reached"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $data = $request->validated();
        $user->update($data);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $user->delete();
        return response()->noContent();
    }
}
