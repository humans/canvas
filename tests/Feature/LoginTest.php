<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function redirect back when credentials are invalid()
    {
        factory(User::class)->create([
            'email'    => 'brian@nsp.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'login'    => 'brian@nsp.com',
            'password' => 'different.password',
        ])->assertSessionHas('error', 'Incorrect username or password.');
    }

    /** @test **/
    function login with an email address()
    {
        factory(User::class)->create([
            'email' => 'brian@nsp.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('login', [
            'login'    => 'brian@nsp.com',
            'password' => 'password',
        ])->assertRedirect('/');
    }

    /** @test **/
    function login with the username()
    {
        factory(User::class)->create([
            'username' => 'nsp',
            'password' => bcrypt('password'),
        ]);

        $this->post('login', [
            'login'    => 'nsp',
            'password' => 'password',
        ])->assertRedirect('/');
    }

    /** @test **/
    function login field is required()
    {
        $this->post('login', [
            'password' => 'password',
        ])->assertSessionHasErrors([
            'login' => 'Enter your username or email address.',
        ]);
    }

    /** @test **/
    function password field is required()
    {
        $this->post('login', [
            'login' => 'nsp',
        ])->assertSessionHasErrors([
            'password' => 'Enter your password.',
        ]);
    }

    /** @test **/
    function the email must exist in the database()
    {
        $this->post('login', [
            'login'    => 'non.existent.email@gmail.com',
            'password' => 'passwordthing',
        ])->assertSessionHasErrors([
            'login' => 'The email is not in our database.',
        ]);
    }

    /** @test **/
    function the username must exist in the database()
    {
        $this->post('login', [
            'login'    => 'non-existent-username',
            'password' => 'passwordthing',
        ])->assertSessionHasErrors([
            'login' => 'The username is not in our database.',
        ]);
    }
}
