<?php

use App\Models\Level;

$factory->define(Level::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
        'code' => $faker->randomLetter . $faker->randomDigit,
    ];
});