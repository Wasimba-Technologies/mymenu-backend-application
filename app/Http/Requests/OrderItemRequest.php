<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
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
            'table_id' => ['required', 'integer'],
            'menu_item_id' => ['required', 'integer'],
            'qty' => ['required', 'integer'],
            'tenant_id' => ['required', 'integer'],
        ];
    }
}
