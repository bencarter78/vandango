<?php

use App\Blink\Models\Referrer;

$factory->define(Referrer::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
    ];
});
