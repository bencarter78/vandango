<?php

use App\Locations\Models\Location;

$factory->define(Location::class, function (Faker\Generator $faker) {
    return [
        'add1' => $faker->buildingNumber . ' ' . $faker->streetName,
        'add2' => '',
        'add3' => '',
        'town' => $faker->city,
        'county' => 'Testshire',
        'postcode' => $faker->postcode,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'owner_id' => $faker->randomDigit,
        'owner_type' => 'App\OwnerClass',
    ];
});