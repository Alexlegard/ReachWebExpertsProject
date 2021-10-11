<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Review;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\GetAddressStrings;
use App\Http\Requests\ShippingAddressRequest;
use App\Http\Requests\BillingAddressRequest;
use Auth;
use Image;

class ProfilesController extends Controller
{
	use GetAddressStrings;
	
    /****************************************************** GET routes */
	public function profile()
	{
		$user = Auth()->user();
		$billingaddress = $this->getBillingAddressString($user->profile);
		$shippingaddress = $this->getShippingAddressString($user->profile);
		
		
		
		return view('profile.profile', [
			'user' => $user,
			'profile' => $user->profile,
			'billing_address' => $billingaddress,
			'shipping_address' => $shippingaddress
		]);
	}
	
	public function editaddress()
	{
		$user = Auth()->user();
		
		return view('profile.edit.address', [
			'user' => $user,
			'profile' => $user->profile
		]);
	}
	
	public function editsettings()
	{
		$user = Auth()->user();
		
		return view('profile.edit.settings', [
			'user' => $user,
			'profile' => $user->profile
		]);
	}
	
	public function changepassword() {
		$user = Auth()->user();
		
		return view('profile.changepassword', [
			'user' => $user,
			'profile' => $user->profile
		]);
	}

	public function editavatar()
	{
		$user = Auth()->user();
		
		return view('profile.edit.avatar', [
			'user' => $user,
			'profile' => $user->profile
		]);
	}
	
	/*********************************************** UPDATE routes */
	public function updateaddress(Request $request, Profile $profile)
	{
		request()->validate([
			'billingstreetaddress' => 'required',
			'billingstreetaddresstwo' => 'sometimes|nullable',
			'billingcity' => 'required',
			'billingstateprovince' => 'required',
			'billingcountry' => 'required',
			'shippingstreetaddress' => 'required',
			'shippingstreetaddresstwo' => 'sometimes|nullable',
			'shippingcity' => 'required',
			'shippingstateprovince' => 'required',
			'shippingcountry' => 'required',
		]);
		
		$shipping_address = [];
		$billing_address = [];
		
		if( $request->filled('billingstreetaddress')) {
			$billing_address = Arr::add(
				$billing_address,
				"streetaddress",
				$request->billingstreetaddress
			);
		}
		if( $request->filled('billingstreetaddresstwo')) {
			$billing_address = Arr::add(
				$billing_address,
				"streetaddresstwo",
				$request->billingstreetaddresstwo
			);
		}
		if( $request->filled('billingcity')) {
			$billing_address = Arr::add(
				$billing_address,
				"city",
				$request->billingcity
			);
		}
		if( $request->filled('billingstateprovince')) {
			$billing_address = Arr::add(
				$billing_address,
				"stateprovince",
				$request->billingstateprovince
			);
		}
		if( $request->filled('billingcountry')) {
			$billing_address = Arr::add(
				$billing_address,
				"country",
				$request->billingcountry
			);
		}
		if( $request->filled('shippingstreetaddress')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"streetaddress",
				$request->shippingstreetaddress
			);
		}
		if( $request->filled('shippingstreetaddresstwo')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"streetaddresstwo",
				$request->shippingstreetaddresstwo
			);
		}
		if( $request->filled('shippingcity')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"city",
				$request->shippingcity
			);
		}
		if( $request->filled('shippingstateprovince')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"stateprovince",
				$request->shippingstateprovince
			);
		}
		if( $request->filled('shippingcountry')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"country",
				$request->shippingcountry
			);
		}
		
		$profile->billing_address = $billing_address;
		$profile->shipping_address = $shipping_address;
		$profile->save();
		
		return redirect('profile');
	}
	
	public function updateshippingaddress(ShippingAddressRequest $request, Profile $profile)
	{
		$shipping_address = [];
		
		$shipping_address = Arr::add(
			$shipping_address,
			"streetaddress",
			$request->streetaddress
		);
		
		if( $request->filled('streetaddresstwo')) {
			$shipping_address = Arr::add(
				$shipping_address,
				"streetaddress",
				$request->streetaddress
			);
		}
		//City
		$shipping_address = Arr::add(
			$shipping_address,
			"city",
			$request->city
		);
		//Stateprovince
		$shipping_address = Arr::add(
			$shipping_address,
			"stateprovince",
			$request->stateprovince
		);
		//Country
		$shipping_address = Arr::add(
			$shipping_address,
			"country",
			$request->country
		);
		
		$profile->shipping_address = $shipping_address;
		$profile->save();
		
		return redirect('checkout');
	}
	
	public function updatebillingaddress(BillingAddressRequest $request, Profile $profile)
	{
		$billing_address = [];
		
		$billing_address = Arr::add(
			$billing_address,
			"streetaddress",
			$request->streetaddress
		);
		
		if( $request->filled('streetaddresstwo')) {
			$billing_address = Arr::add(
				$billing_address,
				"streetaddress",
				$request->streetaddress
			);
		}
		//City
		$billing_address = Arr::add(
			$billing_address,
			"city",
			$request->city
		);
		//Stateprovince
		$billing_address = Arr::add(
			$billing_address,
			"stateprovince",
			$request->stateprovince
		);
		//Country
		$billing_address = Arr::add(
			$billing_address,
			"country",
			$request->country
		);
		
		$profile->billing_address = $billing_address;
		$profile->save();
		
		return redirect('checkout');
	}
	
	public function updatesettings(Request $request, Profile $profile)
	{
		request()->validate([
			'name' => 'required',
			'email' => 'required',
			'description' => 'required'
		]);
		
		$user = $profile->user;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->save();
		
		$profile->description = $request->description;
		$profile->save();
		
		return redirect('profile');
	}

	//Handle user upload of avatar
	public function updateavatar(Request $request, Profile $profile)
	{
		request()->validate([
			'avatar' => 'required'
		]);

		if($request->hasFile('avatar'))
		{
			$avatar = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300, 300)->save( public_path('storage/useravatars/' . $filename) );

			$user = Auth::user();
			$user->avatar = $filename;
			$user->save();
		}

		$billingaddress = $this->getBillingAddressString($user->profile);
		$shippingaddress = $this->getShippingAddressString($user->profile);

		return view('profile.profile', [
			'user' => $user,
			'profile' => $user->profile,
			'billing_address' => $billingaddress,
			'shipping_address' => $shippingaddress
		]);
	}
}















