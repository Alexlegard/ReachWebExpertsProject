<?php

namespace App\Observers;

use App\Restaurant;

class RestaurantObserver
{
    /**
     * Handle the restaurant "created" event.
     *
     * @param  \App\Restaurant  $restaurant
     * @return void
     */
    public function created(Restaurant $restaurant)
    {
		dd("In observer's created method");
        $restaurant_page = new Restaurant_page();
		$restaurant_page->image('default.jpg');
		$restaurant_page->tag('uncategorised');
		$restaurant_page->save();
    }

    /**
     * Handle the restaurant "updated" event.
     *
     * @param  \App\Restaurant  $restaurant
     * @return void
     */
    public function updated(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the restaurant "deleted" event.
     *
     * @param  \App\Restaurant  $restaurant
     * @return void
     */
    public function deleted(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the restaurant "restored" event.
     *
     * @param  \App\Restaurant  $restaurant
     * @return void
     */
    public function restored(Restaurant $restaurant)
    {
        //
    }

    /**
     * Handle the restaurant "force deleted" event.
     *
     * @param  \App\Restaurant  $restaurant
     * @return void
     */
    public function forceDeleted(Restaurant $restaurant)
    {
        //
    }
}
