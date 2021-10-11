<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\SuperAdmin;
use App\User;

/** Test after php artisan migrate:refresh --seed **/
class PutSalePageTest extends TestCase
{
    /** @test **/
    public function admin_can_see_prefilled_form_details()
    {
        $this->refreshApplication();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-dishes/1/sale')
            ->assertStatus(200)
            ->assertSee('5.99') //Edit form needs number not starting with $
            ->assertSee('CAD');
    }

    
    /** @test **/
    public function users_cannot_access_page()
    {
        $this->refreshApplication();

        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('admin/my-dishes/1/sale')
            ->assertStatus(302);
    }

    /** @test **/
    public function guests_cannot_access_page()
    {
        $this->refreshApplication();

        $response = $this->get('admin/my-dishes/1/sale')
            ->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-dishes/1/sale')
            ->assertStatus(302);
    }
}
