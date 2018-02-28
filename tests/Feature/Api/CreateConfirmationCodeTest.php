<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateConfirmationCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function create_a_confirmation_code_and_send_an_email()
    {
        $this->post('/api/confirmation-codes', [
            'email' => 'jaggy@artisan.studio',
        ])->assertJson([
            'response' => true,
        ])->assertStatus(201);

        $this->assertDatabaseHas('confirmation_codes', [
            'email' => 'jaggy@artisan.studio',
        ]);
    }
}
