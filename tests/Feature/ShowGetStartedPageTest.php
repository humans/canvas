<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowGettingStartedPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_the_get_started_page()
    {
        $this->get('/get-started')->assertSuccessful();
    }
}
