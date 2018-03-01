<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationCode;

class CreateConfirmationCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function create_a_confirmation_code_and_send_an_email()
    {
        Mail::fake();

        $this->post('/api/confirmation-codes', [
            'email' => 'jaggy@artisan.studio',
        ])->assertJson([
            'response' => true,
        ])->assertStatus(201);

        $this->assertDatabaseHas('confirmation_codes', [
            'email' => 'jaggy@artisan.studio',
        ]);

        Mail::assertQueued(ConfirmationCode::class, function ($mail) {
            return $mail->hasTo('jaggy@artisan.studio');
        });
    }

    /** @test **/
    function dont_allow_an_empty_email_address()
    {
        $this->json('POST', '/api/confirmation-codes', [
            'email' => null,
        ])->assertStatus(422);
    }
}
