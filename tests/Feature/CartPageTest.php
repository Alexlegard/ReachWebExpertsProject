<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use App\Dish;
use App\User;

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

    
    public function cart_page_contains_cart_items()
    {
        //Arrange
        $user = User::create([
            //Name, email, password, type
            'name'     => 'Alex Legard',
            'email'    => 'alexlegard3@gmail.com',
            'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
            'type'     => 'super'
        ]);

        $restaurant = Restaurant::create([
            'name'               => "Montana's",
            'description'        => 'Smokin Good BBQ',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9065 Airport Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Barbecue",null,null]
        ]);

        $dish = Dish::create([
            'menu_id'       => $restaurant->menu->id,
            'name'          => 'Pork Back Ribs',
            'description'   => 'Four fall off the bone pork back ribs sauced with your choice of BBQ sauce and served with seasoned fries',
            'slug'          => 'slug',
            'price'         => json_decode('{"currency":"CAD","amount":"14.99"}'),
            'special_price' => json_decode('{"currency":"CAD","amount":"11.99"}'),
            'cuisine'       => 'Barbecue',
            'calories'      => 1000,
            'people_served' => 1,
            'stock'         => 100,
            'is_beverage'   => false,
            'is_alcoholic'  => false,
        ]);

        //Act
        $response = $this->actingAs( $user )
            ->visit("dishes/".$dish->id)
            ->click("Add to cart");

        //Assert
        $response->assertSee("asdffdsa");
    }
}
