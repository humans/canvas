<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ShowDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_the_admin_dashboard()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this
            ->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertSuccessful();
    }

    /** @test **/
    function dont_allow_a_guest_to_access_the_page()
    {
        $this
            ->get('/admin/dashboard')
            ->assertStatus(404);
    }

    /** @test **/
    function dont_allow_non_admins_to_access_the_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertStatus(404);
    }
}
