<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:menu_items,name,' . $this->id . ',id',
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['sometimes', 'image'],
            'menu_id' => ['required', 'string'],
            'ingredients' => ['sometimes', 'array'],
            'addons' => ['sometimes', 'array'],
            'variations' => ['sometimes', 'array'],
            'allergens' => ['sometimes', 'array'],
            //validate array contents
            'ingredients.name' => ['required', 'string'],
            'ingredients.quantity' => ['required', 'integer'],
            'ingredients.price' => ['required', 'integer'],
            'addons.name' => ['required', 'string'],
            'addons.quantity' => ['required', 'integer'],
            'addons.price' => ['required', 'string'],
            'variations.name' => ['required', 'string'],
            'variations.price' => ['required', 'integer'],
            'allergens.name' => ['required', 'string'],
        ];
    }
}
