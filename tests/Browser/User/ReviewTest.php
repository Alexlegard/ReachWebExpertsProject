<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Facades\Hash;

class ReviewTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function user_can_post_a_review()
    {
        $this->browse(function (Browser $browser) {
            // User has to login, visit restaurant page, type their review, click on a star rating, and press Post Review.

            $user = User::create([
                'name' => 'Alex Legard',
                'email' => 'alex@alex.ca',
                'password' => Hash::make('password'),
            ]);

            $browser->loginAs( $user )
                ->visit('/')
                ->click('@restaurant-card')
                ->type('review', 'This is a good restaurant.')
                ->click('@star-5')
                ->pause(1000)
                ->click('input[type="submit"]')
                ->assertSee('This is a good restaurant.');
        });
    }
}
