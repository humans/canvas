<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_the_user_profile()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user  = factory(User::class)->create();

        $this
            ->actingAs($admin)
            ->get("/admin/users/{$user->id}")
            ->assertSuccessful();
    }
}
