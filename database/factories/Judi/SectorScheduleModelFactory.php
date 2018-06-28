<?php

use App\Judi\Models\Sector;
use App\Judi\Models\SectorSchedule;

$factory->define(SectorSchedule::class, function () {
    return [
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'month' => rand(0, 12),
    ];
});
