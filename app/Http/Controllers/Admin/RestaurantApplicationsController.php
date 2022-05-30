<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantApplicationRequest;
use App\Http\Controllers\Controller;
use App\RestaurantApplication;
use Auth;

class RestaurantApplicationsController extends Controller
{
	
	// Create a new restaurant application
    public function store(RestaurantApplicationRequest $request)
	{
		$restaurantApplication = new RestaurantApplication;

		$this->storeImage($restaurantApplication);

		$restaurantApplication->address = array(
			"streetaddress"  => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		//Add properties to database one by one...
		if( $request->filled('streetaddresstwo') ) {
			$restaurantApplication->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		
		$restaurantApplication->admin_id = Auth::guard('admin')->user()->id;
		$restaurantApplication->name = request('title');
		$restaurantApplication->description = request('description');
		$restaurantApplication->slug = request('slug');
		$restaurantApplication->cuisine = request('cuisine');
		$restaurantApplication->save(); 
		
		return redirect("/admin/my-restaurants")
			->with('success_message', 'Successfully created application!');
	}


	// Store an image to the storage folder and then to the database.
	private function storeImage($restaurantApplication)
	{
		if(request()->has('image')) {

			$filename = request()->image->getClientOriginalName();
			$unique_name = md5($filename. microtime()).'.png';

			//Store image to the restaurantimages folder
			$restaurantApplication->update([
				'image' => request()->image->storeAs('restaurantapplicationimages', $unique_name, 'public'),
			]);

			$restaurantApplication->image = $unique_name;
		}
	}
}