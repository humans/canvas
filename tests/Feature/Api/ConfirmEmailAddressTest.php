<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ConfirmationCode;

class ConfirmEmailAddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function confirm_the_email_address_and_return_true()
    {
        $code = ConfirmationCode::factory()->create(['email' => 'jaggy@artisan.studio']);

        $this->post('/api/confirm-email', [
            'email' => 'jaggy@artisan.studio',
            'code'  => $code->code,
        ])->assertJson([
            'message' => 'Your email address has been confirmed.',
        ])->assertStatus(200);
    }

    /** @test **/
    function return_false_when_the_code_doesnt_match_the_email_address()
    {
        $this->post('/api/confirm-email', [
            'email' => 'jaggy@artisan.studio',
            'code'  => 'different',
        ])->assertJson([
            'message' => "The confirmation code was incorrect.",
        ])->assertStatus(422);
    }
}
