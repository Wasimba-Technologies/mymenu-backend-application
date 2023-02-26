<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'required|max:255|unique:tenants,name,' . $this->id . ',id',
            'email' => ['required', 'string', 'email'],
            'phone_number' => ['required', 'string'],
            'address_one' => ['required', 'string'],
            'address_two' => ['required', 'string'],
            'country' => ['required', 'string'],
            'logo' => ['sometimes', 'image']
        ];
    }
}
