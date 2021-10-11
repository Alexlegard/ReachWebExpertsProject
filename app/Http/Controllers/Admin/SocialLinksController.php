<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Http\Requests\SocialLinksRequest;
use Auth;

class SocialLinksController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if(Auth::guard('admin')->user()->id != $restaurant->admins()->find(1)->id) {
            return redirect('admin/dashboard');
        }
        
        return view("admin/myRestaurants/socialLinks/edit", [
			'restaurant' => $restaurant
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialLinksRequest $request, Restaurant $restaurant)
    {
        $restaurant->facebook = request('facebook');
		$restaurant->twitter = request('twitter');
		$restaurant->instagram = request('instagram');
		$restaurant->save();
		return redirect("admin/my-restaurants/".$restaurant->id);
    }

    
}
