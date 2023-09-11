<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MenuItemResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
//            'image' => $this->image ? Storage::disk('public')->url($this->image) : null,
            'image' => $this->image,
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
            'addons' => AddonResource::collection($this->whenLoaded('addons')),
            'variations' => VariationValueResource::collection($this->whenLoaded('variation_values')),
            'allergens' => $this->allergens,
            'menu' => new MenuResource($this->menu),
        ];
    }
}
