<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Restaurant;
use Carbon;

class ReviewsController extends Controller
{
	/* Show the user profile reviews page */
    public function listUserReviews()
	{
		$user = Auth()->user();
		$reviews = Review::where("user_id", $user->id)
			->paginate(10);
		
		return view("profile/reviews", [
			"user" => $user,
			"reviews" => $reviews
		]);
	}
	
	public function store(Request $request, Restaurant $restaurant)
	{
		request()->validate([
			'review' => 'required',
			'star'   => 'required'
		]);
		
		$review = new Review;
		$review->user_id = Auth()->user()->id;
		$review->restaurant_id = $restaurant->id;
		$review->content = $request->review;
		$review->rating = $request->star;
		$time = Carbon\Carbon::now();
		$review->time_submitted = $time;
		/*
		$hasRecentlyCommented = Review::where('user_id', $review->user_id)
			->where('restaurant_id', $review->restaurant_id)
			->where('created_at', '<', Carbon\Carbon::now()->subSeconds(20)->toDateTimeString())
			->latest()
			->first();
		if($hasRecentlyCommented) {
			dd("User has commented in the last 20 seconds.");
		} else {
			$review->save();
		}*/

		$review->save();
		
		return redirect("restaurants/" . $restaurant->slug);
	}

	public function delete(Review $review)
	{
		$slug = $review->restaurant->slug;

		$review->delete();

		return redirect('restaurants/'.$slug);
	}
}
