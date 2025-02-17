<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Role;
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
        $this->authorize('viewAny', User::class);
        return new UserCollection(User::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->where('role_id', '!=', Role::CUSTOMER)->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): UserResource | JsonResponse
    {
        $this->authorize('create', User::class);
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
        $this->authorize('view', $user);
        return new UserResource($user->load(['role']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);
        $data = $request->validated();
        $user->update($data);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()->noContent();
    }
}
