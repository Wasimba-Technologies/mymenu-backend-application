<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RestaurantResource extends JsonResource
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
            'address_one' => $this->address_one,
            'address_two' => $this->address_two,
            'country' => $this->country,
            'currency' => $this->currency,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'logo' => env('APP_URL').Storage::url($this->logo),
            'plan' => new PlanResource($this->plan)
        ];
    }
}
