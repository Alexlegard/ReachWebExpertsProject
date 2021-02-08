<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\Order;

/** Run test after php artisan migrate:refresh --seed **/
class SalesPageTest extends TestCase
{
    /** @test **/
    public function testExample()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-sales')
            ->assertStatus(200)
            ->assertSee($order->time_placed)
            ->assertSee($order->billing_name)
            ->assertSee(presentPrice($order->billing_total));
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-sales')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-sales')
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
