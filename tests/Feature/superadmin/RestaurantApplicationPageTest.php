<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\RestaurantApplication;

class RestaurantApplicationPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_restaurant_application_details()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $restaurantapplication = RestaurantApplication::find(1);
        $admin = Admin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/restaurant-applications/1')
            ->assertStatus(200)
            ->assertSee($admin->name)
            ->assertSee($restaurantapplication->slug)
            ->assertSee('8888 Bovaird St East')
            ->assertSee('Sandwiches');
    }

    /** @test **/
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/restaurant-applications/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/restaurant-applications/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function admin_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin)
            ->get('admin/restaurant-applications/1')
            ->assertStatus(302);
    }
}
