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

class OrdersPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_orders()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/orders')
            ->assertStatus(200)
            ->assertSee($order->time_placed)
            ->assertSee($order->billing_name)
            ->assertSee(presentPrice($order->billing_total));
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/orders')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/orders')
            ->assertStatus(302);
    }
}
