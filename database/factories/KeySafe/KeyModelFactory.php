<?php

use App\KeySafe\Models\Key;

$factory->define(Key::class, function (Faker\Generator $faker) {
    return [
        'key' => $faker->unique()->word,
        'first_name' => '',
        'surname' => '',
        'email' => '',
    ];
});