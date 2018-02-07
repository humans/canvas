<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestResponse;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        TestResponse::macro('assertUnauthorized', function () {
            $this->assertStatus(403);

            return $this;
        });

        TestResponse::macro('dd', function () {
            dd($this->session()->get('errors')->all());
        });
    }
}
