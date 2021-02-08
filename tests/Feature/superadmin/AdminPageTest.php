<?php

namespace Tests\Feature\superadmin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class AdminPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    /** @test **/
    public function super_admin_can_see_admin()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);
        $admin = Admin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/admins/1')
            ->assertStatus(200)
            ->assertSee($admin->name)
            ->assertSee($admin->email);
    }

    
    public function user_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/admins/1')
            ->assertStatus(302);
    }

    
    public function guest_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/admins/1')
            ->assertStatus(302);
    }

    
}
