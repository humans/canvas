<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_a_list_of_the_users()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->get('/admin/users')
            ->assertSuccessful();
    }
}
