<?php

namespace Tests;

use PHPUnit\Framework\Assert;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function setUp()
    {
        parent::setUp();

        EloquentCollection::macro('assertContains', function ($assertion) {
            return tap(collect($this->items), function ($collection) use ($assertion) {
                Assert::assertTrue($collection->contains($assertion));
            });
        });

        Hash::setRounds(4);
    }
}
