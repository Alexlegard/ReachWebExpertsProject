<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_register_correctly()
    {
        $this->browse(function (browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Alex')
                ->type('email', 'alex@alex.ca')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->click('button[type="submit"]')
                ->assertSee('Account Settings')
                ->click('#navbarDropdown')
                ->clickLink('Logout')
                ->assertSee('Need a restaurant?');
        });
    }

    /** @test */
    public function a_user_can_login_correctly()
    {
        User::create([
            'name'     => 'Alex Legard',
            'email'    => 'alex@alex.ca',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (browser $browser) {
            $browser->visit('/login')
                ->type('email', 'alex@alex.ca')
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->assertSee('Account Settings')
                ->click('#navbarDropdown')
                ->clickLink('Logout')
                ->assertSee('Need a restaurant?');
        });
    }
}
