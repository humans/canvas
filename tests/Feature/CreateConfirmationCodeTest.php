<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\ConfirmationCode;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;

class CreateConfirmationCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function create_a_confirmation_code_and_send_an_email()
    {
        Mail::fake();

        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio',
        ])->assertCookie(ConfirmationCode::EMAIL)
          ->assertCookie(ConfirmationCode::TIMESTAMP)
          ->assertRedirect('/register');

        $this->assertDatabaseHas('confirmation_codes', [
            'email' => 'jaggy@artisan.studio',
        ]);

        Mail::assertQueued(ConfirmationCodeMail::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }

    /** @test **/
    function dont_allow_an_empty_email_address()
    {
        $this->post('/confirmation-codes', [
            'email' => null,
        ])->assertSessionHasErrors([
            'email',
        ]);
    }

    /** @test **/
    function resend_the_confirmation_code_if_the_email_was_already_used()
    {
        Mail::fake();

        ConfirmationCode::create(['email' => 'jaggy@artisan.studio']);

        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio',
        ])->assertRedirect('/register');

        $this->assertCount(1, ConfirmationCode::get());

        Mail::assertQueued(ConfirmationCodeMail::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }
}
