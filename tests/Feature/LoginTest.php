<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function redirect_back_when_credentials_are_invalid()
    {
        User::factory()->create([
            'email'    => 'brian@nsp.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'login'    => 'brian@nsp.com',
            'password' => 'different.password',
        ])->assertSessionHas('error', "The password doesn't match the given email.");
    }

    /** @test **/
    function login_with_an_email_address()
    {
        User::factory()->create([
            'email' => 'brian@nsp.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('login', [
            'login'    => 'brian@nsp.com',
            'password' => 'password',
        ])->assertRedirect('/');
    }

    /** @test **/
    function login_with_the_username()
    {
        User::factory()->create([
            'username' => 'nsp',
            'password' => bcrypt('password'),
        ]);

        $this->post('login', [
            'login'    => 'nsp',
            'password' => 'password',
        ])->assertRedirect('/');
    }

    /** @test **/
    function login_field_is_required()
    {
        $this->post('login', [
            'password' => 'password',
        ])->assertSessionHasErrors([
            'login' => 'Enter your username or email address.',
        ]);
    }

    /** @test **/
    function password_field_is_required()
    {
        $this->post('login', [
            'login' => 'nsp',
        ])->assertSessionHasErrors([
            'password' => 'Enter your password.',
        ]);
    }

    /** @test **/
    function the_email_must_exist_in_the_database()
    {
        $this->post('login', [
            'login'    => 'non.existent.email@gmail.com',
            'password' => 'passwordthing',
        ])->assertSessionHasErrors([
            'login' => 'The email is not in our database.',
        ]);
    }

    /** @test **/
    function the_username_must_exist_in_the_database()
    {
        $this->post('login', [
            'login'    => 'non-existent-username',
            'password' => 'passwordthing',
        ])->assertSessionHasErrors([
            'login' => 'The username is not in our database.',
        ]);
    }
}

