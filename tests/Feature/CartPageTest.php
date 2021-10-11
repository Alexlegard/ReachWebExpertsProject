<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use App\Dish;
use App\User;

/* Cart page can be visited by anyone even while not logged in.
It displays the cart that is local to your computer I believe. */

/* php artisan migrate:refresh --seed before running any tests */
class CartPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function cart_page_is_empty_with_empty_cart()
    {
        //Act
        $response = $this->get('cart');

        //Assert
        $response->assertStatus(200);
        $response->assertSee("No items in cart");
    }


    /* CartTest in browser directory */
}
