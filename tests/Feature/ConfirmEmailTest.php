<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function show_a_page_with_the_users_email()
    {
        session()->flash('email', 'jake@nine-nine.nyc');

        $this->get('/confirm-email')
            ->assertSuccessful()
            ->assertSee('jake@nine-nine.nyc');
    }
}

