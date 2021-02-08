<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use App\Dish;

/* php artisan migrate:refresh --seed before running any tests */
class DishPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function can_see_name_restaurant_city_description_price_and_cuisine()
    {
        //Arrange
        $restaurant = Restaurant::create([
            'name'               => "Montana's",
            'description'        => 'Smokin Good BBQ',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9065 Airport Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        $dish = Dish::create([
            'menu_id' => $restaurant->menu->id,
            'name' => 'Pork Back Ribs',
            'description' => 'Four fall off the bone pork back ribs sauced with your choice of BBQ sauce and served with seasoned fries',
            'slug' => 'slug',
            'price' => json_decode('{"currency":"CAD","amount":"14.99"}'),
            'special_price' => json_decode('{"currency":"CAD","amount":"11.99"}'),
            'cuisine' => 'Barbecue',
            'calories' => 1000,
            'people_served' => 1,
            'stock' => 100,
            'is_beverage' => false,
            'is_alcoholic' => false,
        ]);

        //Act
        $response = $this->get("dishes/".$dish->id);

        //Assert
        $response->assertStatus(200);
        //Name
        $response->assertSee($dish->name);
        //Restaurant
        $response->assertSee($restaurant->name);
        //City
        $response->assertSee("Brampton");
        //Description
        $response->assertSee($dish->description);
        //Price
        $response->assertSee("$14.99");
        //Cuisine
        $response->assertSee("Barbecue");
    }
}
