<?php

namespace Tests\Feature\profile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

/* php artisan migrate:refresh --seed before running any tests */
class SettingsPageTest extends TestCase
{
    use DatabaseTransactions;
    
    public function user_can_update_their_profile_settings()
    {
        $user = factory(User::class)->create();

        //Act
        $this->actingAs($user)
            ->get('/profile/edit/settings');

        $response = $this->patch(route('profile.edit.settings'), [
            'name'        => 'test',
            'email'       => 'test@test.com',
            'description' => 'test'
        ]);

        
        
        $this->assertEquals('test', $user->name);
        $this->assertEquals('test@test.com', $user->email);
        $this->assertEquals('test', $user->profile->description);
        $response->assertStatus(200);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $response = $this->get('profile/edit/settings')
            ->assertRedirect('login');
    }

    
    public function admins_cannot_access_page()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('profile/edit/settings')
            ->assertRedirect('login');
    }

    
    public function super_admins_cannot_access_page()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->actingAs($superadmin, 'superadmin')
            ->get('profile/edit/settings')
            ->assertRedirect('login');
    }
}
