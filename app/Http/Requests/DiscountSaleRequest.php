<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Restaurant;

class DiscountSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //dd( Auth::guard('admin')->id() ); //Current logged in admin's id
        //dd($this->dish->menu->restaurant->admins);

		if(! Auth::guard('admin')->check() ) {
			return false;
		}

        foreach($this->dish->menu->restaurant->admins as $admin) {
            
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
            'specialprice' => 'required',
			'duration' => 'required'
        ];
    }
}
