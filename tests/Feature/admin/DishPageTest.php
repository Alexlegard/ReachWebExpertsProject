<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;
use App\Dish;

class DishPageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_their_dish_details()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $dish = Dish::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-dishes/1')
            ->assertSee('CAD $7.99')
            ->assertSee('CAD $5.99')
            ->assertSee($dish->slug)
            ->assertSee('Sandwiches')
            ->assertSee($dish->calories)
            ->assertSee($dish->people_served)
            ->assertSee($dish->stock);
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-dishes/1')
            ->assertStatus(302);
    }

   /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-dishes/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-dishes/1')
            ->assertStatus(302);
    }
}
