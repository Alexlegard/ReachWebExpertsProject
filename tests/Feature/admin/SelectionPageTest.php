<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;

/* Test after php artisan migrate:refresh --seed */
class SelectionPageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_selection_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-selections/1')
            ->assertSee('Italian');
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-selections/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-selections/1')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-selections/1')
            ->assertStatus(302);
    }
}
