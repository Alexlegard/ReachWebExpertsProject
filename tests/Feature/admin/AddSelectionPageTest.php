<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Admin;
use App\User;
use App\SuperAdmin;
use App\Dish;

class AddSelectionPageTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test **/
    public function add_new_selection_page_loads_correctly()
    {
        $this->refreshApplication();
        $this->withoutExceptionHandling();

        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'admin')
            ->get('admin/my-dishes/1/selections/add')
            ->assertStatus(200);
    }

    /** @test **/
    public function user_cannot_access_page()
    {
    	$this->refreshApplication();

    	$user = User::find(1);

    	$response = $this->actingAs($user)
    		->get('admin/my-dishes/1/selections/add')
            ->assertStatus(302);
    }

    /** @test **/
    public function guest_cannot_access_page()
    {
    	$this->refreshApplication();

    	$response = $this->get('admin/my-dishes/1/selections/add')
    		->assertStatus(302);
    }

    /** @test **/
    public function super_admin_cannot_access()
    {
        $this->refreshApplication();

        $superadmin = SuperAdmin::find(1);

        $response = $this->get('admin/my-dishes/1/selections/add')
            ->assertStatus(302);
    }
}
