<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function a_user_can_add_an_item_to_their_cart()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@restaurant-card')
                ->clickLink('Shop')
                ->click('@dish-card')
                ->click('button[type="submit"]')
                ->assertSee('1 item in cart');
        });
    }
}
