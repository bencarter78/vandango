<?php

use App\Classroom\Models\User;
use App\Classroom\Models\Timetable;
use App\Classroom\Models\LearningAgreement;

$factory->define(LearningAgreement::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'timetable_id' => function () {
            return factory(Timetable::class)->create()->id;
        },
    ];
});