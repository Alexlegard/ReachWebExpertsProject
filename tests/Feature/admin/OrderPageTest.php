<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\Order;

/** php artisan migrate:refresh --seed before running any tests **/
class OrderPageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_order_details_dishes_and_restaurants()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-orders/1')
            ->assertStatus(200)
            ->assertSee($order->time_placed)
            ->assertSee($order->billing_name)
            ->assertSee($order->billing_email)
            ->assertSee($order->billing_streetaddress)
            ->assertSee($order->billing_city)
            ->assertSee($order->billing_state_province)
            ->assertSee($order->billing_country)
            ->assertSee($order->billing_postalcode)
            ->assertSee($order->billing_name_on_card)
            ->assertSee(presentPrice($order->billing_subtotal))
            ->assertSee(presentPrice($order->billing_tax))
            ->assertSee(presentPrice($order->billing_total))
            ->assertSee($order->payment_gateway)
            ->assertSee('Sweet Onion Chicken Teriyaki')
            ->assertSee('Subway');
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-orders/1')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-orders/1')
            ->assertStatus(302);
    }


    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get()
            ->assertStatus(302);
    }
}
