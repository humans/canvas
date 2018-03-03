<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use App\User;
use App\ConfirmationCode;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    function factory(array $attributes = [])
    {
        return $attributes + [
            'username'              => 'valid.username',
            'name'                  => 'Valid Name',
            'password'              => 'some.password@password$$$',
            'password_confirmation' => 'some.password@password$$$',
        ];
    }

    /** @test **/
    function create_and_log_the_user_in_on_a_successful_reigstration()
    {
        Mail::fake();

        ConfirmationCode::factory()->create(['email' => 'i.am@jag.gy']);

        $this->call('POST', '/register', $this->factory([
            'name' => 'Jaggy Gauran'
        ]), [
            ConfirmationCode::EMAIL => 'i.am@jag.gy'
        ])->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name'  => 'Jaggy Gauran',
            'email' => 'i.am@jag.gy',
        ]);

        $this->assertDatabaseMissing('confirmation_codes', [
            'email' => 'i.am@jag.gy',
        ]);

        Mail::assertQueued(Welcome::class, function ($mail) {
            return $mail->hasTo('i.am@jag.gy');
        });
    }

    /** @test **/
    function dont_allow_an_empty_name()
    {
        $this->post('/register', $this->factory([
            'name' => null
        ]))->assertSessionHasErrors([
            'name'
        ]);
    }

    /** @test **/
    function dont_allow_an_empty_password()
    {
        $this->post('/register', $this->factory([
            'password' => null
        ]))->assertSessionHasErrors([
            'password'
        ]);
    }

    /** @test **/
    function dont_allow_different_passwords()
    {
        $this->post('/register', $this->factory([
            'password'              => 'this is a valid password',
            'password_confirmation' => 'this is a valid but different password',
        ]))->assertSessionHasErrors([
            'password'
        ]);
    }

    /** @test **/
    function dont_allow_a_password_shorter_than_8_characters()
    {
        $this->post('/register', $this->factory([
            'password' => 'short',
            'password_confirmation' => 'short',
        ]))->assertSessionHasErrors([
            'password',
        ]);
    }

    /** @test **/
    function dont_allow_an_empty_username()
    {
        $this->post('/register', $this->factory([
            'username' => null,
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont_allow_duplicate_usernames()
    {
        factory(User::class)->create([
            'username' => 'jaggy'
        ]);

        $this->post('/register', $this->factory([
            'username' => 'jaggy'
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont_allow_a_username_that_starts_with_a_number()
    {
        $this->post('/register', $this->factory([
            'username' => '123username',
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont_allow_a_username_that_starts_with_an_allowed_special_character()
    {
        $this->post('/register', $this->factory([
            'username' => '_username',
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont_allow_a_username_with_special_characters_other_than_dots_and_underscores()
    {
        $this->post('/register', $this->factory([
            'username' => 'u$ername',
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont_allow_duplicate_emails()
    {
        factory(User::class)->create([
            'email' => 'i.am@jag.gy'
        ]);

        $this->call('POST', '/register', $this->factory(), [
            ConfirmationCode::EMAIL => 'i.am@jag.gy'
        ])->assertSessionHasErrors([
            'email'
        ]);
    }
}
