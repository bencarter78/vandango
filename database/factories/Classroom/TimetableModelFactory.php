<?php

use Carbon\Carbon;
use App\RoomMate\Models\Room;
use App\UserManager\Users\User;
use App\Classroom\Models\Course;
use App\Classroom\Models\Timetable;

$factory->define(Timetable::class, function (Faker\Generator $faker) {
    $date = Carbon::now()->addMonths(random_int(1, 11));

    return [
        'course_id' => function () {
            return factory(Course::class)->create()->id;
        },
        'room_id' => function () {
            return factory(Room::class)->create()->id;
        },
        'trainer_id' => function () {
            return factory(User::class)->create()->id;
        },
        'starts_at' => $date,
        'ends_at' => $date->addDays(rand(0, 90)),
    ];
});