<?php

namespace Tests\Feature\profile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

/* php artisan migrate:refresh --seed before running any tests */
class AddressPageTest extends TestCase
{
    use DatabaseTransactions;


    /** @test **/
    public function can_see_address()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('profile/edit/address')
            ->assertSee('');
    }
    
    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/edit/address')
            ->assertRedirect('login');
    }

    
    /** @test **/
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/edit/address')
            ->assertRedirect('login');
    }

    /** @test **/
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/edit/address')
            ->assertRedirect('login');
    }
}
