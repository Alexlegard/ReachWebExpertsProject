<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class AccountPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function authenticated_users_can_see_profile()
    {
        $this->actingAs( User::factory()->create() );

        $response = $this->get('/profile')
            ->assertOk();
    }

    /** @test **/
    public function can_see_name_email_description_shipping_address_and_billing_address()
    {
        $user = User::factory()->create();

        //Act
        $this->actingAs($user)->get('/profile');

        //Assert
        $response = $this->get('/profile')
            ->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->profile->description)
            ->assertSee(getBillingAddress($user))
            ->assertSee(getShippingAddress($user));
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('/profile')
            ->assertRedirect('login');
    }

    /** @test **/
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        //$this->withoutExceptionHandling();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile')
            ->assertRedirect('login');
    }

    
    /** @test **/
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile')
            ->assertRedirect('login');
    }
}
