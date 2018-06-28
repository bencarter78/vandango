<?php

use App\Eportfolios\Models\Centre;

$factory->define(Centre::class, function (Faker\Generator $faker) {
    return [
        'type' => 'onefile',
        'centre_id' => $faker->randomDigit,
        'name' => $faker->word,
    ];
});