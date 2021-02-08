<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;
use App\User;

class RestaurantPageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_restaurant_details()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-restaurants/1')
            ->assertSee('9995 McVean Dr, Brampton, Ontario, Canada')
            ->assertSee('Sandwiches')
            ->assertSee('20%')
            ->assertSee('https://www.facebook.com/subway/')
            ->assertSee('https://twitter.com/SUBWAY')
            ->assertSee('https://www.instagram.com/subway/');
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-profile')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-profile')
            ->assertStatus(302);
    }

    /** @test **/
    public function admin_cannot_access_different_admins_restaurant()
    {

    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get()
            ->assertStatus(302);
    }
}
