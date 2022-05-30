<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RestaurantApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(! Auth::guard('admin')->check() ) {
            return false;
        }

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
            'title' => 'required',
			'description' => 'required',
			'slug' => 'required|unique:restaurants,slug|max:255',
			'streetaddress' => 'required|unique:restaurants,name',
			'streetaddresstwo' => 'sometimes',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
			'cuisine' => 'required',
			'image' => 'sometimes|file|image|max:5000',
        ];
    }
}

/*
'title' => 'required|unique:restaurants,name|max:255',
*/