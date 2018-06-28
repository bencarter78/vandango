<?php

use App\Judi\Models\Criteria;

$factory->define(Criteria::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->words(5, true),
        'description' => $faker->sentence,
    ];
});
