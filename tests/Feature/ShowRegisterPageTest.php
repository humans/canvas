<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ConfirmationCode;

class ShowRegisterPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_the_registration_page_when_the_register_cookie_exists()
    {
        ConfirmationCode::factory()->create(['email' => 'jaggy@artisan.studio']);

        $this->call('GET', '/register', [], [
            ConfirmationCode::EMAIL => encrypt('jaggy@artisan.studio'),
        ])->assertSuccessful();
    }

    /** @test **/
    function redirect_to_the_email_confirmation_when_email_hasnt_been_confirmed()
    {
        $this
            ->get('/register')
            ->assertRedirect('/get-started');
    }

    /** @test **/
    function redirect_to_the_email_confirmation_when_the_email_doesnt_exist()
    {
        $this->call('GET', '/register', [], [
            ConfirmationCode::EMAIL => encrypt('not.an.existing.email@dot.com'),
        ])->assertRedirect('/get-started');
    }
}
