<?php

namespace Tests\Feature\auth;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/* php artisan migrate:refresh --seed before running any tests */
class PasswordResetRequestPageTest extends TestCase
{
    /** @test **/
    public function user_can_see_password_reset_request_page()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }
}
