<?php

use App\Judi\Models\Report;

$factory->define(Report::class, function (\Faker\Generator $faker) {
    return [
        'title' => $faker->words(5, true),
        'description' => $faker->sentence,
    ];
});
