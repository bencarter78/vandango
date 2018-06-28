<?php

use App\Cpd\Organisation;

$factory->define(Organisation::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});