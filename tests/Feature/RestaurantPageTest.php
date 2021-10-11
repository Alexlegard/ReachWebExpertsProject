<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tests\TestCase;
use App\Restaurant;
use App\Review;
use App\User;


/* php artisan migrate:refresh --seed before running any tests */
class RestaurantPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test **/
    public function can_see_restaurant_page()
    {
        //$restaurant = factory(Restaurant::class)->create();

        $restaurant = Restaurant::factory()->create();
        //dd($restaurant->id);

        //Act
        $response = $this->get('restaurants/'.$restaurant->id);

        //Assert
        $response->assertStatus(200);
        $response->assertSee($restaurant->name);
    }

    /** @test **/
    public function can_see_cuisine_and_city()
    {
        $restaurant = Restaurant::factory()->create();

        //Act
        $response = $this->get('restaurants/'.$restaurant->id);

        //Assert
        $response->assertSee("Sandwiches");
        $response->assertSee("Brampton");
    }

    /** @test **/
    public function can_see_address_and_description()
    {
        //Arrange
        $restaurant = Restaurant::create([
            'name'               => "Montana's",
            'description'        => 'Smokin Good BBQ',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9065 Airport Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        //Act
        $response = $this->get('restaurants/'.$restaurant->id);

        //Assert
        $response->assertSee('9065 Airport Rd, Brampton, Ontario, Canada');
        $response->assertSee('Smokin Good BBQ');
    }

    /** @test **/
    public function can_see_user_reviews()
    {
        //Need restaurant, user, and review
        $restaurant = Restaurant::factory()->create();
        $user = User::factory()->create();
        $userid = 1;
        $restaurantid = 1;
        //dd($user);

        $review = Review::create([
            'user_id'        => $user->id,
            'restaurant_id'  => $restaurant->id,
            'rating'         => '4',
            'content'        => $this->faker->paragraph,
            'time_submitted' => now()
        ]);


        //Act
        $response = $this->get('restaurants/'.$restaurant->id);

        //Assert
        $response->assertSee($user->name);
        $response->assertSee($review->content);
    }



    /** @test **/
    public function can_not_see_reviews_for_different_restaurant()
    {
        //Restaurant, otherRestaurant, user, and review
        $restaurant = Restaurant::factory()->create();
        $otherRestaurant = Restaurant::factory()->create();
        $user = User::factory()->make();
        $review = Review::create([
            'user_id'        => 1,
            'restaurant_id'  => 2,
            'rating'         => '4',
            'content'        => $this->faker->paragraph,
            'time_submitted' => now()
        ]);
        

        //Act
        $response = $this->get('restaurants/'.$restaurant->id);

        //Assert
        $response->assertDontSee($review->user->name);
        $response->assertDontSee($review->content);

    }
}
