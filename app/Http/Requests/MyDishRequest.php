<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MyDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if( Auth::guard('admin')->check() ) {
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
			'name' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'pricecurrency' => 'required',
			'priceamount' => 'required',
			'specialprice' => 'sometimes|nullable',
			'cuisine' => 'required',
			'calories' => 'sometimes|nullable',
			'peopleserved' => 'required',
			'stock' => 'required',
			'isbeverage' => 'required',
			'isalcoholic' => 'required',
			'image' => 'sometimes|nullable|file|image|max:5000'
        ];
    }
}
