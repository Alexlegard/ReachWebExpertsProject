<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\User;
use App\Traits\PaginateCollection;

class FeedController extends Controller
{
    use PaginateCollection;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $recent_reviews = $this->getUserFeedRecentReviews($user);
        $followings = $user->followings()->get();

        return view("profile/feed", [
            'user'           => $user,
            'recent_reviews' => $recent_reviews,
            'followings'     => $followings
        ]);
    }

    public function getUserFeedRecentReviews(User $user)
    {
        $followings = $user->followings()->get();
        $recent_reviews = collect();

        foreach($followings as $following)
        {
            foreach($following->review as $review)
            {
                $recent_reviews->push($review);
            }
        }

        $recent_reviews = $this->paginate($recent_reviews, 10);
        return $recent_reviews;
    }
}
