<?php

use App\RoomMate\Models\Room;
use App\RoomMate\Models\Site;

$factory->define(Room::class, function (Faker\Generator $faker) {
    return [
        'site_id' => function () {
            return factory(Site::class)->create()->id;
        },
        'name' => $faker->unique()->word,
        'capacity' => random_int(1, 50),
    ];
});