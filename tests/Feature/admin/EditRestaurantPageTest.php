<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;
use App\Restaurant;

class EditRestaurantPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_prefilled_form_fields()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $restaurant = Restaurant::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/my-restaurants/1/edit')
            ->assertStatus(200)
            ->assertSee($restaurant->name)
            ->assertSee($restaurant->description)
            ->assertSee($restaurant->slug)
            ->assertSee('9995 McVean Dr')
            ->assertSee('Brampton')
            ->assertSee('Ontario')
            ->assertSee('Sandwiches');
    }

    
    public function admin_can_update_their_restaurant()
    {
        $this->refreshApplication();
        $admin = Admin::find(1);
        $restaurant = Restaurant::find(1);
        $uri = 'admin/my-restaurants/'.$restaurant->id;
        $newTitle = 'Subwayasdf';

        $response = $this->actingAs($admin, 'admin')
            ->patch($uri, [
            'title' => $newTitle,
            'description' => 'Eat fresh with our delicious selection of Sandwiches.',
            'slug' => 'slug',
            'streetaddress' => '9995 McVean Dr',
            'city' => 'Brampton',
            'stateprovince' => 'Ontario',
            'country' => 'Canada',
            'cuisine' => 'Sandwiches',
        ])->assertRedirect('admin/my-restaurants')
            ->assertSee($newTitle);

        $response->dumpSession();
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('/admin/my-restaurants/1/edit')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('/admin/my-restaurants/1/edit')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('/admin/my-restaurants/1/edit')
            ->assertStatus(302);
    }
}
