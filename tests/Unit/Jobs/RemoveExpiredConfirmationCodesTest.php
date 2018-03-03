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
        ConfirmationCode::flushEventListeners();

        ConfirmationCode::factory()->states('expired')->times(2)->create();

        ConfirmationCode::factory()->create();

        $this->assertCount(3, ConfirmationCode::get());

        dispatch(new RemoveExpiredConfirmationCodes);
        $this->assertCount(1, ConfirmationCode::get());
    }
}
