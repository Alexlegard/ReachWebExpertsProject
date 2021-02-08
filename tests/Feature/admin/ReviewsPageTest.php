<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;

/** Test after php artisan migrate:refresh --seed **/
class ReviewsPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_their_restaurants_reviews()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-reviews')
            ->assertStatus(200)
            ->assertSee('Posted by Alex Legard on Subway')
            ->assertSee('This is an excellent restaurant.');
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-reviews')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-reviews')
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
