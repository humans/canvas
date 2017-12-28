<?php

namespace Test\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ShowHomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function show_the_landing_when_the_user_isnt_logged_in()
    {
        $this->get('/')->assertViewIs('landing');
    }

    /** @test **/
    public function show_the_home_page_when_the_user_is_logged_in()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get('/')->assertViewIs('home');
    }
}
