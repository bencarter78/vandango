<?php

use App\Apply\Models\Withdrawal;

$factory->define(Withdrawal::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
    ];
});