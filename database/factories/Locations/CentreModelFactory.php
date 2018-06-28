<?php

use App\Locations\Centre;

$factory->define(Centre::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'add1' => $faker->streetAddress,
        'add2' => '',
        'add3' => '',
        'add4' => $faker->city,
        'add5' => $faker->country,
        'post_code' => $faker->postcode,
        'tel' => $faker->phoneNumber,
    ];
});