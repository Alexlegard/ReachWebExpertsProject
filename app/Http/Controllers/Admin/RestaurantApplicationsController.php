<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantApplicationRequest;
use App\Http\Controllers\Controller;
use App\RestaurantApplication;
use Auth;

class RestaurantApplicationsController extends Controller
{
	
    public function store(RestaurantApplicationRequest $request)
	{
		$restaurantApplication = new RestaurantApplication;
		/*
		if($request->has('image')) {
            // resize and upload image
            $path = 'storage/images/' . $request->image->getClientOriginalName();
            $public_path = 'images/' . $request->image->getClientOriginalName();
            $resizedimage = Image::make( $request->image )
                ->resize(300, 200)
                ->save( $path );
            
            $restaurant->image = $public_path;
		}
		*/
		$restaurantApplication->address = array(
			"streetaddress" => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		
		
		if( $request->filled('streetaddresstwo') ) {
			$restaurantApplication->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		$restaurantApplication->admin_id = Auth::guard('admin')->user()->id;
		$restaurantApplication->name = request('title');
		$restaurantApplication->description = request('description');
		$restaurantApplication->slug = request('slug');
		$restaurantApplication->cuisine = request('cuisine');
		
		// Error
		$restaurantApplication->save(); 
		
		return redirect("/admin/my-restaurants")
			->with('success_message', 'Successfully created application!');
	}
}
