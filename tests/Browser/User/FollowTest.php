<?php

namespace Tests\Browser\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\ChangeAddress;
use App\User;
use Illuminate\Support\Facades\Hash;

class FollowTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function user_can_follow_another_user()
    {
        $this->browse(function (Browser $browser) {

            $user = User::create([
                'name' => 'Alex Legard',
                'email' => 'alex@alex.ca',
                'password' => Hash::make('password'),
            ]);

            $browser->loginAs( $user )
                ->visit('/')
                ->click('@restaurant-card')
                ->click('@reviewer-name')
                ->click('@follow')
                ->pause(1000)
                ->assertPresent('@unfollow')
                ->click('@profile')
                ->click('@feed')
                ->assertSee('Alex Legard');
        });
    }
}
