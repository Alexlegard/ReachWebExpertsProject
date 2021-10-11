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
        $user = User::factory()->create();
        $restaurant = Restaurant::factory()->create();
        $dish = Dish::factory()->create();

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

    /** @test **/
    public function user_cannot_see_other_users_orders() {

        $this->refreshApplication();
        
        //Arrange
        $user = User::find(1);

        $otheruser = User::factory()->create();

        $restaurant = Restaurant::find(1);

        //Act & Assert
        //There is an order in the database thanks to the seed.

        $this->actingAs($otheruser)->get('/profile/orders')
            ->assertSee('You have not placed any orders.');
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/orders/1')
            ->assertRedirect('login');
    }

    /** @test **/
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/orders/1')
            ->assertRedirect('login');
    }

    /** @test **/
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/orders/1')
            ->assertRedirect('login');
    }
}
