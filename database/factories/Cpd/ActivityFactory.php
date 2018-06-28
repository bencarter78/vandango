<?php

use App\Cpd\User;
use Carbon\Carbon;
use App\Cpd\Activity;

$factory->define(Activity::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'timetable_id' => null,
        'title' => ucwords($faker->words(3, true)),
        'starts_on' => Carbon::now(),
        'ends_on' => Carbon::now()->addMonth(),
        'completed_on' => Carbon::now()->addMonth(),
        'total_hours' => $faker->randomDigit,
        'grade_id' => $faker->randomDigit,
        'reflection' => $faker->paragraph,
        'deliverer_id' => $faker->randomDigit,
        'path' => 'path/to/my/file',
    ];
});