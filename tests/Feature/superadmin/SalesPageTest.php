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

class SalesPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function super_admin_can_see_sales_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/sales')
            ->assertStatus(200)
            ->assertSee($order->time_placed)
            ->assertSee($order->name_on_card)
            ->assertSee($order->billing_total);
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/sales')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/sales')
            ->assertStatus(302);
    }
}
