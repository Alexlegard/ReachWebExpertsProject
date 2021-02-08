<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RestaurantApplication;
use App\Restaurant;
use App\Admin;
use App\Traits\GetAddressStrings;
use App\Traits\GetCuisinesStrings;
use App\Traits\GetOrders;

class RestaurantApplicationsController extends Controller
{
    use GetAddressStrings;
	use GetCuisinesStrings;
	use GetOrders;
	
	public function index()
	{
		$restaurantApplications = RestaurantApplication::paginate(20);
		
		return view('superadmin/restaurantApplications/index', [
			'restaurantApplications' => $restaurantApplications
		]);
	}
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RestaurantApplication $restaurantApplication)
    {
		//Set address and cuisine
		$address = $this->getRestaurantAddressString($restaurantApplication);
		$cuisines = $this->getRestaurantCuisinesString($restaurantApplication);
		
        return view('superadmin/restaurantApplications/show', [
			'restaurantApplication' => $restaurantApplication,
			'address' => $address,
			'cuisines' => $cuisines
		]);
    }
	
    public function approve(Request $request, RestaurantApplication $restaurantApplication)
	{
		$restaurant = new Restaurant;
		$admin = Admin::find($restaurantApplication->admin_id);
		$restaurant->name = $restaurantApplication->name;
		$restaurant->description = $restaurantApplication->description;
		$restaurant->slug = $restaurantApplication->slug;
		$restaurant->address = $restaurantApplication->address;
		$restaurant->cuisine = $restaurantApplication->cuisine;
		$restaurant->save();
		$restaurant->admins()->sync($admin->id);
		$restaurantApplication->delete();
		
		return redirect('admin/restaurant-applications');
	}
	
	public function deny(RestaurantApplication $restaurantApplication)
	{
		$restaurantApplication->delete();
		
		return redirect('admin/restaurant-applications');
	}
}














