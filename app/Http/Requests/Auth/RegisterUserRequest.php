<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterUserRequest extends FormRequest
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
     * @return array >
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
