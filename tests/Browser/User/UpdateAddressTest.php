<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\ChangeAddress;
use App\User;

class UpdateAddressTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_update_their_shipping_and_billing_address()
    {
        User::create([
            'name'     => 'Alex Legard',
            'email'    => 'alex@alex.ca',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) {

            $browser->loginAs(User::find(1))
                ->visit(new ChangeAddress)
                ->fillInEditAddressForm(
                    '10 Example Street', 'New York City', 'New York',
                    '10 Example Street', 'New York City', 'New York')
                ->click('#navbarDropdown')
                ->clickLink('Logout');
        });
    }
}
