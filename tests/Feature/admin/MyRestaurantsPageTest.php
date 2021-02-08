<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

/* Test after php artisan migrate:refresh --seed */
class MyRestaurantsPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function admins_can_see_their_restaurants()
    {
        $this->refreshApplication();

        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/my-restaurants')
            ->assertStatus(200);
    }

    public function admins_can_visit_add_restaurant()
    {
        $this->refreshApplication();

        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/my-restaurants')
            ->click('Add Restaurant')
            ->assertStatus(200)
            ->assertRedirect('/admin/my-restaurants/create');
    }

    public function admins_can_visit_a_restaurant()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/my-restaurants')
            ->click('Subway')
            ->assertStatus(200)
            ->assertSee('Eat fresh with our wide selection of sandwiches.');
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('/admin/my-restaurants')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('/admin/my-restaurants')
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
