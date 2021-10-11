<?php

namespace Tests\Browser\SuperAdmin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\SuperAdmin;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_super_admin_can_login_correctly()
    {
        SuperAdmin::create([
            'name'     => 'Alex Legard',
            'email'    => 'alex@alex.ca',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (browser $browser) {
            $browser->visit('/superadmin/login')
            ->type('email', 'alex@alex.ca')
            ->type('password', 'password')
            ->click('button[type="submit"]')
            ->assertSee('Welcome Alex Legard');
        });
    }
}
