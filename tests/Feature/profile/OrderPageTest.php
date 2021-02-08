<?php

namespace Tests\Feature\profile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Order;
use App\Dish;
use App\Restaurant;

/* php artisan migrate:refresh --seed before running any tests */
class OrderPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test **/
    public function user_can_see_order_details()
    {
        //Arrange
        $user = factory(User::class)->create();
        $restaurant = factory(Restaurant::class)->create();
        $dish = factory(Dish::class)->create();

        $order = Order::create([
            'user_id'                         => $user->id,
            'billing_email'                   => $this->faker->email,
            'billing_name'                    => $this->faker->name,
            'billing_streetaddress'           => '10 Panda Lane',
            'billing_city'                    => 'Brampton',
            'billing_state_province'          => 'Ontario',
            'billing_country'                 => 'Canada',
            'billing_postalcode'              => 'q4q4q4',
            'billing_name_on_card'            => $this->faker->name,
            'billing_subtotal'                => '10.97',
            'billing_subtotal_after_discount' => '10.97',
            'billing_tax'                     => '1.42',
            'billing_total'                   => '12.39',
            'billing_commission'              => '2.48',
            'payment_gateway'                 => 'Stripe',
            'shipped'                         => false,
            'time_placed'                     => $this->faker->dateTimeThisMonth
        ]);

        //Act
        $this->actingAs($user)->get('/profile/orders/'.$order->id);

        //Assert
        $response = $this->get('/profile/orders/'.$order->id)
            ->assertStatus(200)
            ->assertSee($order->billing_name_on_card)
            ->assertSee('No')
            ->assertSee(presentPrice($order->billing_subtotal))
            ->assertSee(presentPrice($order->billing_tax))
            ->assertSee(presentPrice($order->billing_total))
            ->assertSee(getOrderBillingAddress($order));
    }

    public function user_cannot_see_other_users_orders() {

        //Arrange
        $user = User::create([
            //Name, email, password, type
            'name' => 'testuserblah',
            'email' => 'testuserblah@gmail.com',
            'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
            'type' => 'super'
        ]);

        $user = User::create([
            //Name, email, password, type
            'name' => 'testuserblah2',
            'email' => 'testuserblah2@gmail.com',
            'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
            'type' => 'super'
        ]);

        $restaurant = Restaurant::create([
            'name'               => 'testrestaurantblah',
            'description'        => 'Eat fresh with our wide selection of sandwiches.',
            'slug'               => 'slug',
            'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => ["Sandwiches",null,null],
        ]);

        $order = Order::create([
            'user_id' => $otheruser->id,
            'billing_email' => 'alexlegard3@gmail.com',
            'billing_name' => 'Alex Legard',
            'billing_streetaddress' => '10 Panda Lane',
            'billing_city' => 'Brampton',
            'billing_state_province' => 'Ontario',
            'billing_country' => 'Canada',
            'billing_postalcode' => 'q4q4q4',
            'billing_name_on_card' => 'Alex Legard',
            'billing_subtotal' => '10.97',
            'billing_tax' => '1.42',
            'billing_total' => '12.39',
            'billing_commission' => '2.48',
            'payment_gateway' => 'Stripe',
            'shipped' => false,
            'time_placed' => '2020-07-13',
        ]);

        $dish = Dish::create([
            'menu_id' => $restaurant->menu->id,
            'name' => 'Sweet Onion Chicken Teriyaki',
            'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
            'slug' => 'slug',
            'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
            'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
            'cuisine' => 'Sandwiches',
            'calories' => 1000,
            'people_served' => 1,
            'stock' => 100,
            'is_beverage' => false,
            'is_alcoholic' => false
        ]);

        //Act
        $this->actingAs($user)->get('/profile/orders/'.$order->id);

        //Assert
        $response = $this->get('/profile/orders/'.$order->id)
            ->assertSee('You have no orders.');
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/orders/1')
            ->assertRedirect('login');
    }

    
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/orders/1')
            ->assertRedirect('login');
    }

    
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/orders/1')
            ->assertRedirect('login');
    }
}
