<?php

namespace Tests\Feature\profile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;
use App\Restaurant;
use App\Favorite;

/* php artisan migrate:refresh --seed before running any tests */
class FavoritesPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function user_can_see_favorite_restaurants()
    {
        $user = factory(User::class)->create();
        $restaurant = factory(Restaurant::class)->create();
        
        $favorite = Favorite::create([
            'user_id'       => $user->id,
            'restaurant_id' => $restaurant->id
        ]);

        //Act
        $this->actingAs($user)->get('/profile/favorites/');

        //Assert
        $response = $this->get('/profile/favorites')
            ->assertStatus(200)
            ->assertSee($restaurant->name)
            ->assertSee(getAddress($restaurant));
    }

    /** @test **/
    public function user_can_not_see_not_favorited_restaurant()
    {
        //Arrange
        $user = factory(User::class)->create();

        $restaurant = factory(Restaurant::class)->create();

        //Act
        $this->actingAs($user)->get('/profile/favorites/');

        //Assert
        $response = $this->get('/profile/favorites')
            ->assertDontSee($restaurant->name)
            ->assertDontSee(getAddress($restaurant));
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/favorites')
            ->assertRedirect('login');
    }

    
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/favorites')
            ->assertRedirect('login');
    }

    
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/favorites')
            ->assertRedirect('login');
    }
}
