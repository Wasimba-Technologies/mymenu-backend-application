<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'name' => 'required|max:255|',
            'start_time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|after_or_equal:start_date|date_format:H:i:s',
            'image' => ['sometimes', 'image'],
        ];
    }
}
