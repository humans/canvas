<?php

use Faker\Generator as Faker;

$factory->define(App\ConfirmationCode::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
    ];
});
