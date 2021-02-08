<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Restaurant;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/* php artisan migrate:refresh --seed before running any tests */
class WelcomePageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function can_see_welcome_page()
    {
        //Arrange

        //Act
        $response = $this->get('/');

        //Assert
        $response->assertStatus(200);
        $response->assertSee("Need a restaurant?");
    }

    /** @test **/
    public function user_can_see_restaurant()
    {
        $restaurant = Restaurant::find(1);

        //Act
        $response = $this->get("/");

        //Assert
        $response->assertSee($restaurant->name);
    }
}
