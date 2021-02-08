<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\Restaurant;

class RestaurantSocialLinksPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_prefilled_form_data()
    {
        $this->refreshApplication();
        $admin = Admin::find(1);
        $restaurant = Restaurant::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/my-restaurants/1/social-links/edit')
            ->assertStatus(200)
            ->assertSee($restaurant->facebook)
            ->assertSee($restaurant->twitter)
            ->assertSee($restaurant->instagram);
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('/admin/my-restaurants/1/social-links/edit')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('/admin/my-restaurants/1/social-links/edit')
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
