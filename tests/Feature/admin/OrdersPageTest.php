<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;
use App\Order;

/* php artisan migrate:refresh --seed before running any tests */
class OrdersPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $order = Order::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-orders')
            ->assertStatus(200)
            ->assertSee($order->time_placed)
            ->assertSee($order->billing_name_on_card)
            ->assertSee(presentPrice($order->billing_total));
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-orders')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-orders')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-orders')
            ->assertStatus(302);
    }
}
