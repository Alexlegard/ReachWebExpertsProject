<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class UserPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_user_details()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $user = User::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/users/1')
            ->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->created_at);
    }

    /** @test **/
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/users/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/users/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function admin_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin)
            ->get('admin/users/1')
            ->assertStatus(302);
    }
}
