<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\Welcome;

class ActivateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function activate_the_user_and_redirect_to_the_login_page()
    {
        Mail::fake();

        $user = factory(User::class)->states('inactive')->create([
            'username' => 'jake',
            'email'    => 'jake@nine-nine.nyc',
        ]);

        $this->get("activate?token={$user->activation_token}")->assertSessionHas([
            'message' => 'Your account is now activated.',
        ])->assertRedirect('/login');

        $user->refresh();

        $this->assertNotNull(
            $user->activated_at,
            'The activation date must be set.'
        );

        $this->assertNull(
            $user->activation_token,
            'The token must be deleted once the user is activated.'
        );

        Mail::assertQueued(Welcome::class, function ($mail) {
            return $mail->hasTo('jake@nine-nine.nyc');
        });
    }

    /** @test **/
    function dont_allow_an_empty_activation_token()
    {
        $this->get('activate?token=')->assertRedirect('/');
    }

    /** @test **/
    function dont_allow_an_non_existing_activation_token()
    {
        $this->get('activate?token=non-existing-token')->assertStatus(404);
    }

    /** @test **/
    function redirect_a_logged_in_user_to_the_home_page()
    {
        $inactive = factory(User::class)->states('inactive')->create();
        $active   = factory(User::class)->create();

        $this->actingAs($active)
            ->get("activate?token={$inactive->activation_token}")
            ->assertRedirect('/');
    }
}

