<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use App\ConfirmationCode;

class ConfirmationCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function check_if_the_confirmation_code_is_expired()
    {
        $now = now();

        Carbon::setTestNow(now()->addDays(2));
        $code = ConfirmationCode::factory()->create();

        Carbon::setTestNow($now);
        $this->assertFalse($code->isExpired());

        Carbon::setTestNow(now()->subDays(2));
        $code = ConfirmationCode::factory()->create();

        Carbon::setTestNow($now);
        $this->assertTrue($code->isExpired());
    }
}
