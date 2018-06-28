<?php

use App\Ignite\Models\Campaign;

$factory->define(Campaign::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
    ];
});