<?php

namespace Tests\Feature;

use Compose\Invite;
use Compose\User;
use Compose\Events\UserRegistered;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    function setUp()
    {
        parent::setUp();

        $this->invite = factory(Invite::class)->create([
            'email' => 'i.am@jag.gy'
        ]);

        Event::fake();
    }

    function factory(array $attributes = [])
    {
        return $attributes + [
            'email'    => $this->invite->email,
            'name'     => 'Valid Name',
            'username' => 'validaname',
            'token'    => $this->invite->token,

            'password' => 'some.password@password$$$',
            'password_confirmation' => 'some.password@password$$$',
        ];
    }

    /** @test **/
    function invalidate when the invite code doesnt exist()
    {
        $this->get(route('register', [
            'token' => 'invalidtoken',
        ]))->assertStatus(404);
    }

    /** @test **/
    function access the page when the invite code is valid()
    {
        $invite = factory(Invite::class)->create();

        $this->get(route('register', [
            'token' => $invite->token
        ]))->assertStatus(200);
    }

    /** @test **/
    function send in the invite to the view()
    {
        $invite = factory(Invite::class)->create();

        $this->get(route('register', [
            'token' => $invite->token
        ]))->assertViewHas([
            'invite'
        ]);
    }

    /** @test **/
    function create and log the user in on a successful reigstration()
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
    function dont allow an empty name()
    {
        $this->post('/register', $this->factory([
            'name' => null
        ]))->assertSessionHasErrors(['name']);
    }

    /** @test **/
    function dont allow an empty email()
    {
        $this->post('/register', $this->factory([
            'email' => null
        ]))->assertSessionHasErrors(['email']);
    }

    /** @test **/
    function dont allow an empty username()
    {
        $this->post('/register', $this->factory([
            'username' => null
        ]))->assertSessionHasErrors(['username']);
    }

    /** @test **/
    function dont allow an empty password()
    {
        $this->post('/register', $this->factory([
            'password' => null
        ]))->assertSessionHasErrors(['password']);
    }

    /** @test **/
    function dont allow different passwords()
    {
        $this->post('/register', $this->factory([
            'password' => 'this is a valid password',
            'password_confirmation' => 'this is a valid but different password',
        ]))->assertSessionHasErrors([
            'password'
        ]);
    }

    /** @test **/
    function dont allow a password shorter than 8 characters()
    {
        $this->post('/register', $this->factory([
            'password' => 'short',
            'password_confirmation' => 'short',
        ]))->assertSessionHasErrors([
            'password',
        ]);
    }

    /** @test **/
    function dont allow invalid usernames()
    {
        $this->post('/register', $this->factory([
            'username' => '$massively_invalidT3st--'
        ]))->assertSessionHasErrors([
            'username'
        ]);
    }

    /** @test **/
    function dont allow invalid emails()
    {
        $this->post('/register', $this->factory([
            'email' => 'notanemail'
        ]))->assertSessionHasErrors([
            'email'
        ]);
    }

    /** @test **/
    function dont allow if the token has already been used()
    {
        $this->invite->update(['accepted_at' => \Carbon\Carbon::now()]);

        $this->post('/register', $this->factory())
            ->assertSessionHasErrors([
                'token' => 'The invite has already been used.'
            ]);
    }

    /** @test **/
    function dont allow if the email doesnt match the token()
    {
        $this->post('/register', $this->factory([
            'email' => 'not.the.same.email@gmail.com',
        ]))->assertSessionHasErrors([
            'token' => 'The invite does not match the email address.'
        ]);
    }
}
