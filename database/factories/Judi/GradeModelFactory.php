<?php

use App\Judi\Models\Grade;

$factory->define(Grade::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
    ];
});
