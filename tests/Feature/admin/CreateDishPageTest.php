<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\Dish;

/* Test after php artisan migrate:refresh --seed */
class CreateDishPageTest extends TestCase
{
    /** @test **/
    public function admin_can_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $dish = Dish::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-restaurants/1/create-dish')
            ->assertStatus(200)
            ->assertSee('Add Dish');
    }

    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-restaurants/1/create-dish')
            ->assertStatus(302);
    }

    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-restaurants/1/create-dish')
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
