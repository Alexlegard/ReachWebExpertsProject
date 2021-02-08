<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BillingAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if( Auth::check() ) {
			return true;
		}
        return false;
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
        ];
    }
}
