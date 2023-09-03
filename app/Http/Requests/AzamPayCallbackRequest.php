<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AzamPayCallbackRequest extends FormRequest
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
            'msisdn' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'message' => ['required', 'string'],
            'operator' => ['required', 'string'],
            'utilityref' => ['required', 'string'],
            'reference' => ['required', 'string'],
            'transactionstatus' => ['required', 'string'],
            'submerchantAcc' => ['required', 'string'],
            'mnoreference' => ['required', 'string'],
            'additionalProperties' => ['required', 'array'],
//            'additionalProperties.*.property1' => ['string', 'nullable'],
//            'additionalProperties.*.property2' => ['string', 'nullable'],
        ];
    }
}
