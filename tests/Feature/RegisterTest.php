<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\Activation;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    function factory(array $attributes = [])
    {
        return $attributes + [
            'email'                 => 'validemail@email.com',
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

        $this->post('/register', $this->factory([
            'name'     => 'Jaggy Gauran',
            'email'    => 'i.am@jag.gy',
        ]))->assertSessionHas([
            'email', 'activation_token',
        ])->assertRedirect(
            '/confirm-email'
        );

        $this->assertDatabaseHas('users', [
            'name'  => 'Jaggy Gauran',
            'email' => 'i.am@jag.gy',
        ]);

        $this->assertNotNull(User::first()->activation_token);

        Mail::assertSent(Activation::class, function ($mail) {
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
    function dont_allow_an_empty_email_address()
    {
        $this->post('/register', $this->factory([
            'email' => null
        ]))->assertSessionHasErrors([
            'email'
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
    function dont_allow_invalid_emails()
    {
        $this->post('/register', $this->factory([
            'email' => 'notanemail'
        ]))->assertSessionHasErrors([
            'email'
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
}
