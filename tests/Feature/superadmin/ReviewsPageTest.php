<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class ReviewsPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_reviews()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/reviews')
            ->assertStatus(200)
            ->assertSee('Subway')
            ->assertSee('From Alex Legard on 2020-07-17');
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/reviews')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/reviews')
            ->assertStatus(302);
    }
}
