<?php

use App\Classroom\Models\Guest;

$factory->define(Guest::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->email,
    ];
});
