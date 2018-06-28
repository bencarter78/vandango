<?php

use App\Judi\Models\Cancellation;

$factory->define(Cancellation::class, function (\Faker\Generator $faker) {
    return [
        'type' => $faker->words(3, true),
    ];
});
