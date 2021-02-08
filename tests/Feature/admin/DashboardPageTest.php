<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Admin;
use App\SuperAdmin;

class DashboardPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function guest_users_cannot_access_admin_dashboard()
    {
        $this->refreshApplication();

        $response = $this->get('/admin/dashboard')
            ->assertRedirect('/');
    }

    /** @test **/
    public function users_cannot_access_admin_dashboard()
    {
        $this->refreshApplication();
        $this->actingAs( factory(User::class)->create() );

        $response = $this->get('/admin/dashboard')
            ->assertRedirect('/');
    }

    /** @test **/
    public function admins_can_access_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();

        // Returns 200 status
        $response = $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertStatus(200);
    }

    /** @test **/
    public function super_admins_can_access_admin_dashboard()
    {
        $superadmin = factory(SuperAdmin::class)->create();

        // Returns unwanted 302 status
        $this->actingAs( factory(SuperAdmin::class)->create() )
            ->get('/admin/dashboard')
            ->assertOk();
    }

    public function admins_can_see_their_name_weekly_orders_and_weekly_sales()
    {
        $admin = Admin::create([
            //Name, email, password, type
            'id'                 => '1',
            'name'               => 'Evan Legard',
            'email'              => 'evanlegard3@gmail.com',
            'password'           => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertSee('Evan Legard')
            ->assertSee('$0.00');
    }
}
