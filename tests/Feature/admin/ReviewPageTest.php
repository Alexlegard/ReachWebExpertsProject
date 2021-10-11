<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;
use App\Review;

/* Test after php artisan migrate:refresh --seed */
class ReviewPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_review_details()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);
        $review = Review::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-reviews/1')
            ->assertStatus(200)
            ->assertSee($review->user->name)
            ->assertSee($review->time_submitted)
            ->assertSee($review->content);
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-reviews/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-reviews/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-reviews/1')
            ->assertStatus(302);
    }
}
