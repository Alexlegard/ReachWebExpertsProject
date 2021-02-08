<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class DishesPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_dishes()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/dishes')
            ->assertStatus(200)
            ->assertSee('Subway')
            ->assertSee('Sweet Onion Chicken Teriyaki')
            ->assertSee('Chocolate Cookie')
            ->assertSee('Diet Coke');
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/dishes')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/dishes')
            ->assertStatus(302);
    }
}
