<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;
use App\Restaurant;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
		$restaurants = Restaurant::with('review')->get();
		
		return view("superadmin/reviews/index", [
			'reviews' => $reviews,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
		$restaurant = $review->restaurant;
		
        return view("superadmin/reviews/show", [
			'review' => $review,
			'restaurant' => $restaurant
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
		
		return redirect("admin/reviews");
    }
}
