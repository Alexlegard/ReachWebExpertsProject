<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\RestaurantApplication;
use App\Restaurant;
use App\Admin;
use App\Traits\GetAddressStrings;
use App\Traits\GetCuisinesStrings;
use App\Traits\GetOrders;
use Illuminate\Support\Facades\Storage;
use Image;

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
	
	// Approve the specified restaurant application.
    public function approve(Request $request, RestaurantApplication $restaurantApplication)
	{

		$request = new Request([
		    'slug' => $restaurantApplication->slug
		    // The restaurantApplication has lots of other fields, but we
		    // literally only care about slug...
		]);

		$this->validate($request, [
		    'slug' => 'required|unique:restaurants,slug|max:255'
		]);


		// Create the new restaurant
		$restaurant = new Restaurant;
		$admin = Admin::find($restaurantApplication->admin_id);
		$restaurant->name = $restaurantApplication->name;
		$restaurant->description = $restaurantApplication->description;
		$restaurant->slug = $restaurantApplication->slug;
		$restaurant->address = $restaurantApplication->address;
		$restaurant->cuisine = $restaurantApplication->cuisine;

		// Store an image to the storage then the database and delete the old
    	// one from storage.
    	if( isset($restaurantApplication->image) ) {

    		$restaurant->image = $this->setImage($restaurant, $restaurantApplication);
    		//dd($restaurantApplication->image);
			$restaurant->image = $restaurantApplication->image;
		}

		$restaurant->save();
		$restaurant->admins()->sync($admin->id);
		$this->deleteImage($restaurantApplication->image);
		$restaurantApplication->delete();
		
		return redirect('admin/restaurant-applications');
	}
	
	// Deny the specified restaurant application.
	public function deny(RestaurantApplication $restaurantApplication)
	{
		$this->deleteImage($restaurantApplication->image);
		$restaurantApplication->delete();
		
		return redirect('admin/restaurant-applications');
	}

	public function deleteImage($image)
	{
		$path = 'restaurantapplicationimages/'.$image;

        Storage::disk('public')->delete($path);
	}

	// Store an image to the storage then the database and delete the old
    // one from storage.
	private function setImage($restaurant, $restapp)
	{
			//f0a47065d1b86feb98e07f5bdc67a0ba.png

			$oldpath = storage_path('storage/restaurantapplicationimages/' . $restapp->image);
			$oldfilepath = 'restaurantapplicationimages/' . $restapp->image;
			$paththree = 'storage/restaurantapplicationimages/' . $restapp->image;

			// We save the image as a new file
			try {
				//dd($paththree);
				$img = Image::make($paththree);
			} catch(\Exception $exception) {
				return view('errors.imagenotfound');
			}
			
			//dd("after try/catch");

			// Finally we delete it from storage
			Storage::disk('public')->delete($oldfilepath);

			// Save the image
			$img->save('storage/restaurantimages/'.$restapp->image);

			// Save restaurant->image
			$restaurant->image = $restapp->image;
	}
}














