<?php

use App\Blink\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => strtolower($faker->firstName . "." . $faker->lastName),
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'deleted_at' => null,
    ];
});
