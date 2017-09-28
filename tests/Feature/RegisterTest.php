<?php

namespace Tests\Feature;

use App\User;
use App\Events\UserRegistered;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    function setUp()
    {
        parent::setUp();

        Event::fake();
    }

    function factory(array $attributes = [])
    {
        return $attributes + [
            'email'    => 'validemail@email.com',
            'name'     => 'Valid Name',
            'username' => 'validaname',

            'password' => 'some.password@password$$$',
            'password_confirmation' => 'some.password@password$$$',
        ];
    }

    /** @test **/
    function invalidate_when_the_invite_code_doesnt_exist()
    {
        $this->get('/register')
            ->assertStatus(404);
    }

    /** @test **/
    function create_and_log_the_user_in_on_a_successful_reigstration()
    {
        $this->post('/register', $this->factory([
            'name'     => 'Jaggy Gauran',
            'email'    => 'i.am@jag.gy',
            'username' => 'jaggygauran',
        ]))->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name'  => 'Jaggy Gauran',
            'email' => 'i.am@jag.gy',
        ]);

        $this->assertEquals('Jaggy Gauran', auth()->user()->name);
        $this->assertEquals('i.am@jag.gy', auth()->user()->email);

        Event::assertDispatched(UserRegistered::class);
    }

    /** @test **/
    function dont_allow_an_empty_name()
    {
        $this->post('/register', $this->factory([
            'name' => null
        ]))->assertSessionHasErrors(['name']);
    }

    /** @test **/
    function dont_allow_an_empty_email()
    {
        $this->post('/register', $this->factory([
            'email' => null
        ]))->assertSessionHasErrors(['email']);
    }

    /** @test **/
    function dont_allow_an_empty_username()
    {
        $this->post('/register', $this->factory([
            'username' => null
        ]))->assertSessionHasErrors(['username']);
    }

    /** @test **/
    function dont_allow_an_empty_password()
    {
        $this->post('/register', $this->factory([
            'password' => null
        ]))->assertSessionHasErrors(['password']);
    }

    /** @test **/
    function dont_allow_different_passwords()
    {
        $this->post('/register', $this->factory([
            'password' => 'this is a valid password',
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
    function dont_allow_invalid_usernames()
    {
        $this->post('/register', $this->factory([
            'username' => '$massively_invalidT3st--'
        ]))->assertSessionHasErrors([
            'username'
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
    function dont_allow_if_the_token_has_already_been_used()
    {
        $this->invite->update(['accepted_at' => \Carbon\Carbon::now()]);

        $this->post('/register', $this->factory())
            ->assertSessionHasErrors([
                'token' => 'The invite has already been used.'
            ]);
    }

    /** @test **/
    function dont_allow_if_the_email_doesnt_match_the_token()
    {
        $this->post('/register', $this->factory([
            'email' => 'not.the.same.email@gmail.com',
        ]))->assertSessionHasErrors([
            'token' => 'The invite does not match the email address.'
        ]);
    }
}
