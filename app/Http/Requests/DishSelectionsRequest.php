<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Dish;

class DishSelectionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //dd($this->dishselection->dish->menu->restaurant);

		if(! Auth::guard('admin')->check() ) {
			return false;
		}

        //dd(Dish::find($this->id));
        $dish = Dish::find($this->id);

        foreach($dish->menu->restaurant->admins as $admin) {
            
            if( Auth::guard('admin')->id() == $admin->id ) {
                return true;
            }
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
			'options' => 'required',
			'radio_or_checkbox' => 'required'
        ];
    }
}
