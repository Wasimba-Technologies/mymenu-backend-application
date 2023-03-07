<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'menu_items' => $this->menu_items,
            'users' => $this->users,
            'orders' => $this->orders,
            'dedicated_support' => $this->dedicated_support,
        ];
    }
}
