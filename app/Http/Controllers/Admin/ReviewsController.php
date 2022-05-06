<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Restaurant;
use App\User;
use App\Review;
use Carbon;
use Auth;
use App\Traits\PaginateCollection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

// Admin-side reviews controller
class ReviewsController extends Controller
{
	use PaginateCollection;
	
	/* My reviews */
	public function index()
	{
		$admin = Auth::guard('admin')->user();
		$reviews_array = array();
		
		foreach($admin->restaurants as $restaurant) {
			foreach($restaurant->review as $review) {
				array_push($reviews_array, $review);
			}
		}
		$reviews = collect($reviews_array)->sortBy('time_submitted');
		$reviews =  $this->paginate($reviews,10);
		
		return view("admin/reviews/list", [
			'reviews' => $reviews
		]);
	}
	
	public function show(Review $review)
	{
		$restaurant = $review->restaurant;

		$this->authorize('owns-restaurant', $restaurant);

		return view("admin/reviews/show", [
			"review" => $review
		]);
	}
	
	public function destroy(Review $review) {

		$restaurant = $review->restaurant;
		
		$this->authorize('delete-review', $review);

		$review->delete();
		
		return redirect("admin/my-reviews");
	}
}













