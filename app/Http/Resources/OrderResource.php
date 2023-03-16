<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->isoFormat('D MMM YYYY HH:mm'),
            'updated_at' => Carbon::parse($this->updated_at)->isoFormat('D MMM YYYY HH:mm'),
            'table' => new TableResource($this->whenLoaded('table')),
            'order_items' => $this->whenLoaded('menu_items'),
            'restaurant' => new RestaurantResource($this->whenLoaded('tenant'))
        ];
    }
}
