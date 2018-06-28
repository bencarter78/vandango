<?php

use App\Apply\Models\QualificationType;

$factory->define(QualificationType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'employed' => true,
        'non_employed' => true,
    ];
});

$factory->state(QualificationType::class, 'employed', function (Faker\Generator $faker) {
    return [
        'employed' => true,
        'non_employed' => false,
    ];
});

$factory->state(QualificationType::class, 'nonEmployed', function (Faker\Generator $faker) {
    return [
        'employed' => false,
        'non_employed' => true,
    ];
});