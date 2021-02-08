<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use App\Dish;

/* php artisan migrate:refresh --seed before running any tests */
class ListDishesPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function can_see_dish()
    {
        //Arrange
        $restaurant = Restaurant::create([
            'name'               => "Montana's",
            'description'        => 'Smokin Good BBQ',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9065 Airport Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        /* For restaurant: Subway */
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
        $response = $this->get("restaurants/".$restaurant->id."/dishes");

        //Assert
        $response->assertStatus(200);
        $response->assertSee($dish->name);
        $response->assertSee($dish->description);


    }

    /** @test **/
    public function can_not_see_dish_from_other_restaurant()
    {
        //Arrange
        $restaurant = Restaurant::create([
            'name'               => "test",
            'description'        => 'Eat Fresh',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        $otherRestaurant = Restaurant::create([
            'name'               => "test 2",
            'description'        => 'Smokin Good BBQ',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9065 Airport Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        $dish = Dish::create([
            'menu_id' => $restaurant->menu->id,
            'name' => 'Sweet Onion Chicken Teriyaki',
            'description' => 'Delicious chicken teriyaki...',
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

        $otherDish = Dish::create([
            'menu_id' => $otherRestaurant->menu->id,
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
        $response = $this->get("restaurants/".$restaurant->id."/dishes");

        //Assert
        $response->assertDontSee($otherDish->name);
        $response->assertDontSee($otherDish->description);
    }
}
