<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Admin;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_admin_can_login_correctly()
    {
        Admin::create([
            'name'     => 'Alex Legard',
            'email'    => 'alex@alex.ca',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (browser $browser) {
            $browser->visit('/admin/login')
            ->type('email', 'alex@alex.ca')
            ->type('password', 'password')
            ->click('button[type="submit"]')
            ->assertSee('Welcome Alex Legard');
        });
    }
}
