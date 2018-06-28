<?php

use App\Classroom\Models\Course;
use App\Classroom\Models\CourseType;

$factory->define(Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->words(3, true),
        'description' => $faker->paragraph,
        'course_type_id' => function () {
            return factory(CourseType::class)->create(['name' => 'Classroom'])->id;
        },
        'is_mandatory' => true,
        'is_agreement_required' => true,
        'cost' => random_int(0, 99999),
    ];
});