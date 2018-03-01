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
        $code = ConfirmationCode::create(['email' => 'jaggy@artisan.studio']);

        $this->post('/api/confirm-email', [
            'email' => 'jaggy@artisan.studio',
            'code'  => $code->code,
        ])->assertJson([
            'response' => true,
        ]);
    }

    /** @test **/
    function return_false_when_the_code_doesnt_match_the_email_address()
    {
        $this->post('/api/confirm-email', [
            'email' => 'jaggy@artisan.studio',
            'code'  => 'different',
        ])->assertJson([
            'response' => false,
        ]);
    }
}
