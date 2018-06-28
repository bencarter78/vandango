<?php

use App\RoomMate\Models\Site;

$factory->define(Site::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->words(3, true)),
        'tel' => $faker->phoneNumber,
        'is_owned' => $faker->boolean,
        'has_disabled_access' => $faker->boolean,
        'parking' => $faker->paragraph,
        'opens_at' => '2017-01-01 08:30:00',
        'closes_at' => '2017-01-01 17:00:00',
    ];
});