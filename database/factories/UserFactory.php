<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'             => $name = $faker->name,
        'username'         => str_slug($name),
        'email'            => $faker->unique()->safeEmail,
        'password'         => $password ?: $password = bcrypt('secret'),
        'activation_token' => null,
        'activated_at'     => now(),
        'remember_token'   => str_random(10),
    ];
});


$factory->state(App\User::class, 'inactive', function (Faker $faker) {
    return [
        'activation_token' => str_random(10),
        'activated_at'     => null
    ];
});

$factory->state(App\User::class, 'admin', function (Faker $faker) {
    return ['is_admin' => true];
});
