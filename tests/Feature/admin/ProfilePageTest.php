<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\AdminProfile;

/** Test after php artisan migrate:refresh --seed **/
class ProfilePageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function admin_can_see_their_profile_details()
    {
        $this->refreshApplication();
        $admin = Admin::find(1);
        $profile = AdminProfile::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-profile')
            ->assertStatus(200)
            ->assertSee($admin->name)
            ->assertSee($admin->email)
            ->assertSee($profile->description);
    }

    
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-profile')
            ->assertStatus(302);
    }

    
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-profile')
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
