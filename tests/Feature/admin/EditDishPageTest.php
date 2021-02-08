<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\Dish;

class EditDishPageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_prefilled_form_details()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $dish = Dish::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-dishes/1/edit')
            ->assertStatus(200)
            ->assertSee($dish->name)
            ->assertSee($dish->description)
            ->assertSee($dish->slug)
            ->assertSee('7.99') //Edit form needs numbers without $
            ->assertSee('5.99')
            ->assertSee($dish->cuisine)
            ->assertSee($dish->people_served)
            ->assertSee($dish->stock);
    }

   
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-dishes/1/edit')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-dishes/1/edit')
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
