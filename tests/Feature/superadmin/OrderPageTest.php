<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Order;

class OrderPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_order_details()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/orders/1')
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
            ->assertSee($order->payment_gateway);
    }

    /** @test **/
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/orders/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/orders/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function admin_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin)
            ->get('admin/orders/1')
            ->assertStatus(302);
    }
}
