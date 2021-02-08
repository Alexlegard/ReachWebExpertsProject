<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;

/* Test after php artisan migrate:refresh --seed */
class LogoutPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_logout_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/logout')
            ->assertStatus(200)
            ->assertSee('Logout?');
    }

    /** @test **/
    public function super_admin_can_see_logout_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('admin/logout')
            ->assertStatus(200)
            ->assertSee('Logout?');
    }

    
    public function users_cannot_see_logout_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/logout')
            ->assertStatus(302);
    }

    
    public function guests_cannot_see_logout_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/logout')
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
