<?php

use App\Models\Nas\Framework;

$factory->define(Framework::class, function (Faker\Generator $faker) {
    return [
        'code' => strtoupper(str_random(5)),
        'full_name' => ucwords($faker->words(3, true)),
        'short_name' => ucwords($faker->words(3, true)),
        'occupation_code' => strtoupper(str_random(5)),
        'occupation_full_name' => ucwords($faker->words(5, true)),
        'occupation_short_name' => ucwords($faker->words(2, true)),
    ];
});