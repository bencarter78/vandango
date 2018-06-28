<?php

use App\Classroom\Models\CourseType;

$factory->define(CourseType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->words(3, true),
    ];
});
