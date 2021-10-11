<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class ChangeAddress extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/profile';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@submit' => 'input[type="submit"]',
        ];
    }


    public function fillInEditAddressForm(Browser $browser, $billstreet, $billcity, $billstate, $shipstreet, $shipcity, $shipstate)
    {
        $browser->visit('/profile')
            ->assertSee('Account Settings')
            ->clickLink('Change Address')
            ->assertSee('Editing Address')
            ->type('billingstreetaddress', $billstreet )
            ->type('billingcity', $billcity )
            ->type('billingstateprovince', $billstate )
            ->type('shippingstreetaddress', $shipstreet )
            ->type('shippingcity', $shipcity )
            ->type('shippingstateprovince', $shipstate )
            ->click('@submit')
            ->assertSee( $billstreet )
            ->assertSee( $billcity )
            ->assertSee( $billstate )
            ->assertSee( $shipstreet )
            ->assertSee( $shipcity )
            ->assertSee( $shipstate );
    }
}
