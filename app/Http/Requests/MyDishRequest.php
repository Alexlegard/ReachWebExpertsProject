<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Restaurant;
use App\Dish;

class MyDishRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	//dd($this->request);

		if(! Auth::guard('admin')->check() ) {
			return false;
		}

		//$dish = Dish::firstWhere('name', $this->name);
		//$restaurant = $dish->menu->restaurant;

		// The currently logged in admin id must match the restaurant
		// admin's id.
		//foreach($restaurant->admins as $admin) {
            
        //    if( Auth::guard('admin')->id() == $admin->id ) {
        //        return true;
        //    }
        //}

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
