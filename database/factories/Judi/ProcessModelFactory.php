<?php

use App\Judi\Models\Process;

$factory->define(Process::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
        'trigger_week' => $faker->randomDigit,
    ];
});
