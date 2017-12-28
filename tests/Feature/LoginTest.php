<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function redirect_to_the_home_page_when_the_login_is_successful()
    {
        factory(User::class)->create([
            'email'    => 'existing.email@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email'    => 'existing.email@gmail.com',
            'password' => 'password',
        ])->assertRedirect('/');
    }

    /** @test **/
    function redirect_back_when_credentials_are_invalid()
    {
        factory(User::class)->create([
            'email'    => 'existing.email@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email'    => 'existing.email@gmail.com',
            'password' => 'different.password',
        ])->assertSessionHas('error', "The password doesn't match the email address provided.");
    }

    /** @test **/
    function the_email_field_is_required()
    {
        $this->post('/login', [
            'password' => '12345678'
        ])->assertSessionHasErrors([
            'email' => 'Enter your email address.',
        ]);
    }

    /** @test **/
    function password_field_is_required()
    {
        $this->post('/login', [
            'email' => 'existing.email@gmail.com',
        ])->assertSessionHasErrors([
            'password' => 'Enter your password.',
        ]);
    }

    /** @test **/
    function the_email_must_exist_in_the_database()
    {
        $this->post('/login', [
            'email'    => 'non.existent.email@gmail.com',
            'password' => 'passwordthing',
        ])->assertSessionHasErrors([
            'email' => 'That email address is not in our records.',
        ]);
    }
}
