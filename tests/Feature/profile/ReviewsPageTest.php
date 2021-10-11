<?php

namespace Tests\Feature\profile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Restaurant;
use App\Review;

/* php artisan migrate:refresh --seed before running any tests */
class ReviewsPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test **/
    public function can_see_review_content()
    {
        //Arrange
        $user = User::factory()->create();
        $restaurant = Restaurant::factory()->create();
        
        $review = Review::create([
            'user_id'        => $user->id,
            'restaurant_id'  => $restaurant->id,
            'rating'         => '4',
            'content'        => $this->faker->paragraph,
            'time_submitted' => now()
        ]);

        //Act
        $response = $this->actingAs($user)->get('profile/reviews');

        //Assert
        $response->assertStatus(200);
        $response->assertSee($review->content);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/reviews')
            ->assertRedirect('login');
    }

    /** @test **/
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/reviews')
            ->assertRedirect('login');
    }

    /** @test **/
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/reviews')
            ->assertRedirect('login');
    }
}
