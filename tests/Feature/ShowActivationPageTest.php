<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\Welcome;

class ShowActivationPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_the_activation_page()
    {
        Mail::fake();

        $user = factory(User::class)->states('inactive')->create([
            'username' => 'jake',
            'email'    => 'jake@nine-nine.nyc',
        ]);

        $this
            ->get("activate?token={$user->activation_token}")
            ->assertRedirect('/login');

        $user->refresh();

        $this->assertNotNull($user->activated_at, 'The activation date must be set.');
        $this->assertNull($user->activation_token, 'The token must be deleted once the user is activated.');

        Mail::assertQueued(Welcome::class, function ($mail) {
            return $mail->hasTo('jake@nine-nine.nyc');
        });
    }

    /** @test **/
    function dont_allow_an_empty_activation_token()
    {
        $this->get("activate?token=")
            ->assertRedirect('/');
    }

    /** @test **/
    function dont_allow_an_invalid_activation_token()
    {
    }
}

