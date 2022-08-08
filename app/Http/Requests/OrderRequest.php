<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\ValidationRules\Rules\Currency;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'currency' => [
                'required',
                new Currency(),         // VALID ISO 4217 CURRENCY VALIDATION
                Rule::in(array_values(config('constants.CURRENCIES'))),
            ],
            'email' => 'required|email|email:rfc|email:dns',
        ];
    }
}
