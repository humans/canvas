<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function return_all_the_inactive_users()
    {
        factory(User::class)->times(2)->states('inactive')->create();

        factory(User::class)->times(1)->create();

        $this->assertCount(2, User::inactive()->get());
    }

    /** @test **/
    function return_the_user_with_the_given_activation_token()
    {
        factory(User::class)->create([
            'username'         => 'terry',
            'activation_token' => 'yogurt',
        ]);

        $this->assertEquals('terry', User::byActivationToken('yogurt')->username);
    }

    /** @test **/
    function activate_the_user_by_adding_a_timestamp_and_removing_the_activation_token()
    {
        $user = factory(User::class)->states('inactive')->create();

        $this->assertNotNull($user->activation_token);
        $this->assertNull($user->activated_at);

        $user->activate();

        $this->assertNull($user->activation_token);
        $this->assertNotNull($user->activated_at);
    }
}