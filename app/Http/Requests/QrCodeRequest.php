<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class QrCodeRequest extends FormRequest
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
            'color' => ['required', 'string'],
            'width' => ['required', 'integer'],
            'caption_line_one' => ['required', 'string'],
            'caption_line_two' => ['required', 'string'],
            'sub_caption' => ['required', 'string'],
            'logo' => ['sometimes', 'image']
        ];
    }
}
