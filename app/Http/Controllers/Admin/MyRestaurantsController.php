<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Traits\GetAddressStrings;
use App\Traits\GetCuisinesStrings;
use App\Traits\GetOrders;
use App\Http\Requests\MyRestaurantRequest;
use Illuminate\Support\Facades\Storage;

class MyRestaurantsController extends Controller
{
	use GetAddressStrings;
	use GetCuisinesStrings;
	use GetOrders;
	
    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$admin = Auth::guard('admin')->user();
		$restaurants = $admin->restaurants()->paginate(20);
		
		
        return view("admin/myRestaurants/index", [
			'restaurants' => $restaurants,
			'admin' => $admin
		]);
    }

    /**
     * Show the form for creating a new restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/myRestaurants/create");
    }

    /**
     * Store a newly created restaurant application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyRestaurantRequest $request)
    {
		$restaurant = new Restaurant;
		
		$restaurant->address = array(
			"streetaddress" => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		if( $request->filled('streetaddresstwo') ) {
			$restaurant->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		$restaurant->name = request('title');
		$restaurant->description = request('description');
		$restaurant->slug = request('slug');
		$restaurant->cuisine = request('cuisine');
		$restaurant->save();
		
		$admin = Auth::guard('admin')->user();
		//dd($admin);
		$restaurant->admins()->sync($admin);
		
		return redirect("/admin/my-restaurants");
    }

    /**
     * Display the specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$restaurant = Restaurant::find($id);

    	// There's something wrong with authorization.
    	// 403 | This action is unauthorized.
    	// Also, didn't I adjust my AuthServiceProvider recently
    	// because it was messing with my unit tests?
    	$this->authorize('owns-restaurant', $restaurant);
		
		$admin = Auth::guard('admin')->user();
		$address = $this->getRestaurantAddressString($restaurant);
		$cuisines = $this->getRestaurantCuisinesString($restaurant);
		$orders = $this->getOrdersFromRestaurant($restaurant);
		$reviews = $restaurant->review;
		
        return view("admin/myRestaurants/show", [
			'restaurant' => $restaurant,
			'address'    => $address,
			'cuisines'   => $cuisines,
			'orders'     => $orders,
			'reviews'    => $reviews
		]);
    }

    /**
     * Show the form for editing the specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$restaurant = Restaurant::where('id', $id)->first();

		$this->authorize('owns-restaurant', $restaurant);

		if(Auth::guard('admin')->user()->id != $restaurant->admins()->find(1)->id) {
			return redirect('admin/dashboard');
		}
		
        return view("admin/myRestaurants/edit", [
			'restaurant' => $restaurant
		]);
    }

    /**
     * Update the specified restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Route::patch('my-restaurants/{restaurant}')
     */
    public function update(MyRestaurantRequest $request, Restaurant $restaurant)
    {
    	$this->authorize('owns-restaurant', $restaurant);

    	// Store an image to the storage then the database and delete the old
    	// one from storage.
		$this->updateImage($restaurant);
		
		$restaurant->address = array(
			"streetaddress"  => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		$restaurant->cuisine = array(
			$request->cuisineone,
			$request->cuisinetwo,
			$request->cuisinethree
		);
		
		if( $request->filled('streetaddresstwo') ) {
			$restaurant->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		$restaurant->name = request('title');
		$restaurant->description = request('description');
		$restaurant->slug = request('slug');
		$restaurant->cuisine = request('cuisine');
		
		$restaurant->save();
		
		return redirect("admin/my-restaurants/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
		$this->authorize('owns-restaurant', $restaurant);
		
		$this->deleteImage($restaurant->image);
        $restaurant->delete();
		
		return redirect("/admin/my-restaurants");
    }
	
	public function createdish(Restaurant $restaurant) {

		$this->authorize('owns-restaurant', $restaurant);
		
		return view("admin/myRestaurants/createDish", [
			'restaurant' => $restaurant
		]);
	}

	// Store an image to the storage then the database and delete the old
    // one from storage.
	private function updateImage($restaurant)
	{
		if(request()->has('image')) {

			$oldpath = 'restaurantimages/'.$restaurant->image;
			$filename = request()->image->getClientOriginalName();
			//dd($oldfilename);
			$unique_name = md5($filename. microtime()).'.png';

			//Store image to the restaurantimages folder
			$restaurant->update([
				'image' => request()->image->storeAs('restaurantimages', $unique_name, 'public'),
			]);

			//Delete old file name from storage
			Storage::disk('public')->delete($oldpath);


			$restaurant->image = $unique_name;
		}
	}

	//When a restaurant is deleted, also delete its image from storage.
	private function deleteImage($image)
	{
		$path = 'restaurantimages/'.$image;

        Storage::disk('public')->delete($path);
	}
}

















