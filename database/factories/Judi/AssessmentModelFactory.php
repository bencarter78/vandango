<?php

use App\Judi\Models\User;
use App\Judi\Models\Sector;
use App\Judi\Models\Process;
use App\Judi\Models\Assessment;
use App\Judi\Models\Cancellation;

$factory->define(Assessment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'assessor_id' => function () {
            return factory(User::class)->create()->id;
        },
        'assessment_date' => $faker->date(),
        'process_id' => function () {
            return factory(Process::class)->create()->id;
        },
        'entry' => $faker->paragraph(),
        'notes' => $faker->paragraph(),
        'cancellation_id' => function () {
            return factory(Cancellation::class)->create()->id;
        },
    ];
});
