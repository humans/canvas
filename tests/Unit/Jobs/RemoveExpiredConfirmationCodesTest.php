<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use App\Jobs\RemoveExpiredConfirmationCodes;
use App\ConfirmationCode;

class RemoveExpiredConfirmationCodesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function remove_all_the_expired_confirmation_codes()
    {
        $lastWeek = now()->subDays(7);
        $tomorrow = now()->addDays(1);
        $now      = now();

        Carbon::setTestNow($lastWeek);
        factory(ConfirmationCode::class, 2)->create();

        Carbon::setTestNow($tomorrow);
        factory(ConfirmationCode::class)->create();

        Carbon::setTestNow($now);
        factory(ConfirmationCode::class)->create();

        $this->assertCount(4, ConfirmationCode::get());

        dispatch(new RemoveExpiredConfirmationCodes);
        $this->assertCount(1, ConfirmationCode::get());
    }
}
