<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\ChangeAddress;
use App\User;
use Illuminate\Support\Facades\Hash;

class OrderTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function user_can_place_an_order()
    {
        $this->browse(function (Browser $browser) {

            $user = User::create([
                'name' => 'Alex Legard',
                'email' => 'alex@alex.ca',
                'password' => Hash::make('password'),
            ]);

            $browser->loginAs( $user )
                ->visit( new ChangeAddress )
                ->fillInEditAddressForm(
                    '10 Example Street', 'New York City', 'New York',
                    '10 Example Street', 'New York City', 'New York')
                ->clickLink('Home')
                ->click('@restaurant-card')
                ->clickLink('Shop')
                ->click('@dish-card')
                ->click('button[type="submit"]')
                ->assertSee('1 item in cart')
                ->clickLink('Checkout')
                ->assertSee('Confirm Password')
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->type('card_name', 'Alex Legard')
                ->type('postal_code', 'Q4Q4Q4')
                ->waitFor('iframe[name^=__privateStripeFrame]')
                ->withinFrame('iframe[name^=__privateStripeFrame]', function($browser){
                    $browser->pause(3000);
                    $browser->keys('input[placeholder="Card number"]', '4242 4242 4242 4242')
                        ->keys('input[placeholder="MM / YY"]', '1250')
                        ->keys('input[placeholder="CVC"]', '123');
                });

                $browser->driver->switchTo()->defaultContent();

                $browser->click('button[type="submit"]')
                    ->pause(10000)
                    ->assertSee('Thank you!');
        });
    }
}
