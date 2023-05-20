<?php

namespace App\Http\Resources;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'role_id' => $this->role_id,
            'tenant_id' => $this->tenant_id,
            'tenant' => $this->tenant,
            'role' => new RoleResource($this->whenLoaded('role')),
            'permissions' => $this->role->role_permissions->merge($this->user_permissions),
        ];
    }
}
