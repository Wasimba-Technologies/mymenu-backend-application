<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'name' => 'required|max:255|unique:menus,name,' . $this->id . ',id',
            'start_time' => ['present', 'date_format:H:i', 'before:end_time','nullable'], //
            'end_time' => ['present', 'date_format:H:i', 'after:start_time', 'nullable'],
            'image' => ['required', 'image'],
        ];
    }
}
