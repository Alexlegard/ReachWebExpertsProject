<?php

namespace App\Policies\admin;

use App\Review;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Review $review)
    {
        dd("policies/admin");

        foreach($review->restaurant->admins as $ad)
        {
            if($admin->id === $ad->id){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Review $review)
    {
        //
    }
}
