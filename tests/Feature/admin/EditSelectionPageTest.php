<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use App\Admin;
use App\SuperAdmin;
use Tests\TestCase;

class EditSelectionPageTest extends TestCase
{
    /** @test **/
    public function user_can_see_edit_selection_page()
    {
        $this->refreshApplication();
        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-selections/1/edit')
            ->assertSee('Editing Bread');
    }

    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-selections/1/edit')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-selections/1/edit')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-selections/1/edit')
            ->assertStatus(302);
    }
}
