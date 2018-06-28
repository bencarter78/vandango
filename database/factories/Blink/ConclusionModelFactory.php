<?php

use App\Blink\Models\Conclusion;

$factory->define(Conclusion::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
    ];
});