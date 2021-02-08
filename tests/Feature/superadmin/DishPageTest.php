<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Dish;

class DishPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_dish_details()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $dish = Dish::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/dishes/1')
            ->assertStatus(200)
            ->assertSee($dish->description)
            ->assertSee(presentPrice($dish->price['amount']))
            ->assertSee(presentPrice($dish->special_price['amount']))
            ->assertSee($dish->slug)
            ->assertSee($dish->cuisine)
            ->assertSee($dish->calories)
            ->assertSee($dish->people_served)
            ->assertSee($dish->stock);
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/dishes/1')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/dishes/1')
            ->assertStatus(302);
    }
}
