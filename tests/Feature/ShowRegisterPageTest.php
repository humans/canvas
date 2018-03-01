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
        $this->call('GET', '/register', [], [
            ConfirmationCode::EMAIL     => encrypt('jaggy@artisan.studio'),
            ConfirmationCode::TIMESTAMP => now(),
        ])->assertSuccessful();
    }

    /** @test **/
    function redirect_to_the_email_confirmation_when_email_hasnt_been_confirmed()
    {
        $this
            ->get('/register')
            ->assertRedirect('/get-started');
    }
}
