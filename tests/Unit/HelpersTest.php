<?php

namespace Test\Unit;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    /** @test **/
    function check_if_a_string_is_an_email_or_not()
    {
        $this->assertTrue(is_email('jaggy@artisan.studio'));
        $this->assertFalse(is_email('jaggy'));
    }

    /** @test **/
    function check_the_login_field_of_the_string_provided()
    {
        app('request')->replace(['login' => 'jaggy@artisan.studio']);
        $this->assertEquals('email', login_field());

        app('request')->replace(['login' => 'jaggy']);
        $this->assertEquals('username', login_field());
    }
}
