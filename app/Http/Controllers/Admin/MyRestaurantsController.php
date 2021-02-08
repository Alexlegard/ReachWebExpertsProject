<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Traits\GetAddressStrings;
use App\Traits\GetCuisinesStrings;
use App\Traits\GetOrders;

class MyRestaurantsController extends Controller
{
	use GetAddressStrings;
	use GetCuisinesStrings;
	use GetOrders;
	
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/myRestaurants/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		request()->validate([
			'title' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'streetaddress' => 'required',
			'streetaddresstwo' => 'sometimes',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
			'cuisine' => 'required',
			'image' => 'sometimes|file|image|max:5000',
		]);
		
		$restaurant = new Restaurant;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
		$admin = Auth::guard('admin')->user();
		$restaurant = Restaurant::find($id);
		$address = $this->getRestaurantAddressString($restaurant);
		$cuisines = $this->getRestaurantCuisinesString($restaurant);
		$orders = $this->getOrdersFromRestaurant($restaurant);
		
		
		if(Auth::guard('admin')->user()->id != $restaurant->admins()->find(1)->id) {
			return redirect('admin/dashboard');
		}
		
        return view("admin/myRestaurants/show", [
			'restaurant' => $restaurant,
			'address' => $address,
			'cuisines' => $cuisines,
			'orders' => $orders
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$restaurant = Restaurant::where('id', $id)->first();

		if(Auth::guard('admin')->user()->id != $restaurant->admins()->find(1)->id) {
			return redirect('admin/dashboard');
		}
		
        return view("admin/myRestaurants/edit", [
			'restaurant' => $restaurant
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Route::patch('my-restaurants/{restaurant}')
     */
    public function update(Request $request, Restaurant $restaurant)
    {
    	//dd($request);

        request()->validate([
			'title' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'streetaddress' => 'required',
			'streetaddresstwo' => 'sometimes',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
			'cuisine' => 'required',
			'image' => 'sometimes|file|image|max:5000',
		]);
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
			//dd("Request has streetaddresstwo");
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
		//dd($restaurant);
		
        $restaurant->delete();
		
		return redirect("/admin/my-restaurants");
    }
	
	public function createdish(Restaurant $restaurant) {
		
		return view("admin/myRestaurants/createDish", [
			'restaurant' => $restaurant
		]);
	}
}

















