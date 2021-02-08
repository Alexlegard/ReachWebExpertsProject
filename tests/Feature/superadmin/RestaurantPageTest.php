<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Restaurant;

class RestaurantPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_restaurant_details()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $restaurant = Restaurant::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/restaurants/1')
            ->assertStatus(200)
            ->assertSee($restaurant->description)
            ->assertSee('9995 McVean Dr, Brampton, Ontario, Canada')
            ->assertSee('Sandwiches')
            ->assertSee($restaurant->commission)
            ->assertSee($restaurant->slug);
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/restaurants/1')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/restaurants/1')
            ->assertStatus(302);
    }
}
