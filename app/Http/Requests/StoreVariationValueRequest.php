<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVariationValueRequest extends FormRequest
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
            'variation_id' => ['required', 'exists:variations,id'],
            'name' => ['required', 'string', 'max:255'],
            'is_incrementing' => ['required', 'boolean'],
            'price' => ['required', 'integer'],
            'type' => ['required', 'string'],
        ];
    }
}
