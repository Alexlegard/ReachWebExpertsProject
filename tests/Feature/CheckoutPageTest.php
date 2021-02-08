<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;

/* php artisan migrate:refresh --seed before running any tests */
class CheckoutPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function user_must_confirm_password()
    {
        $user = User::find(1);

        //Act
        $this->actingAs($user)->get('/checkout');

        //Assert
        $response = $this->get('/checkout')
            ->assertStatus(302)
            ->assertRedirect('/password/confirm');
    }
}
