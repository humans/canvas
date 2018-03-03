<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\ConfirmationCode;
use App\User;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;

class CreateConfirmationCodeTest extends TestCase
{
    use RefreshDatabase;

    function setUp()
    {
        parent::setUp();

        Mail::fake();
    }

    /** @test **/
    function create_a_confirmation_code_and_send_an_email()
    {
        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio'
        ])->assertCookie(ConfirmationCode::EMAIL)
          ->assertRedirect('/register');

        $this->assertDatabaseHas('confirmation_codes', [
            'email' => 'jaggy@artisan.studio'
        ]);

        Mail::assertQueued(ConfirmationCodeMail::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }

    /** @test **/
    function dont_allow_an_empty_email_address()
    {
        $this->post('/confirmation-codes', [
            'email' => null
        ])->assertSessionHasErrors([
            'email'
        ]);
    }

    /** @test **/
    function dont_allow_an_invalid_email_address()
    {
        $this->post('/confirmation-codes', [
            'email' => 'not.an.email.address'
        ])->assertSessionHasErrors([
            'email'
        ]);
    }

    /** @test **/
    function dont_allow_duplicate_emails()
    {
        User::factory()->create([
            'email' => 'jaggy@artisan.studio'
        ]);

        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio'
        ])->assertSessionHasErrors([
            'email'
        ]);
    }

    /** @test **/
    function resend_the_confirmation_code_if_the_email_was_already_used()
    {
        ConfirmationCode::factory()->create(['email' => 'jaggy@artisan.studio']);

        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio'
        ])->assertRedirect('/register');

        $this->assertCount(1, ConfirmationCode::get());

        Mail::assertQueued(ConfirmationCodeMail::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }

    /** @test **/
    function reset_the_confirmation_code_when_its_already_expired()
    {
        ConfirmationCode::flushEventListeners();

        $code = ConfirmationCode::factory()->states('expired')->create([
            'email' => 'jaggy@artisan.studio'
        ]);

        $this->post('/confirmation-codes', [
            'email' => 'jaggy@artisan.studio'
        ])->assertRedirect('/register');

        $this->assertDatabaseMissing('confirmation_codes', [
            'code' => $code->code,
        ]);

        Mail::assertQueued(ConfirmationCodeMail::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }
}
