<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name' => 'required|max:255|unique:restaurants,name,' . $this->id . ',id',
            'menu_items' => ['required', 'integer'],
            'users' => ['required', 'integer'],
            'orders' => ['required', 'integer'],
            'dedicated_support' => ['required', 'boolean'],
        ];
    }
}
