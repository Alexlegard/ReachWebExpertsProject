<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SocialLinksRequest extends FormRequest
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

        foreach($this->restaurant->admins as $admin) {
            
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
            'facebook' => 'sometimes|nullable|url',
			'twitter' => 'sometimes|nullable|url',
			'instagram' => 'sometimes|nullable|url'
        ];
    }
}
