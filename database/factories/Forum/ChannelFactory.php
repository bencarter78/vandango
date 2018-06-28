<?php

use App\Forum\Channel;

$factory->define(Channel::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->unique()->words(3, true)),
    ];
});
