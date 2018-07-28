<?php

use Faker\Generator as Faker;

$factory->define(App\ConfirmationCode::class, function (Faker $faker) {
    return [
        'email'      => $faker->email,
        'code'       => 123456,
        'expires_at' => now()->addDays(7),
    ];
});


$factory->state(App\ConfirmationCode::class, 'expired', function (Faker $faker) {
    return ['expires_at' => now()->subDays(7)];
});
