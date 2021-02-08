<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
			'streetaddress' => 'required',
			'streetaddresstwo' => 'sometimes|nullable',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
            'card_name' => 'required',
            'postal_code' => 'required'
        ];
    }
	
	public function messages()
	{
		$missing_address = "You must first complete your billing address.";
		
		return [
			'streetaddress.required' => $missing_address,
			'city.required' => $missing_address,
			'stateprovince.required' => $missing_address,
			'country.required' => $missing_address,
			'card_name.required' => 'Card name field is required.',
			'postal_code.required' => 'Postal code field is required.'
		];
	}
}