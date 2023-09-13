<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariationValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'variation_name' => $this->whenLoaded('variation', function () {
                return $this->variation->name;
            }),
            'name' => $this->name,
            'is_incrementing' => $this->is_incrementing,
            'type' => $this->type,
            'price' => $this->price,
        ];
    }
}
