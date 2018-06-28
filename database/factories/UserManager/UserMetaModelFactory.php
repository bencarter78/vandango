<?php

use App\UserManager\Users\UserMeta;

$factory->define(UserMeta::class, function (Faker\Generator $faker) {
    return [
        'tel' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'appraisal_date' => $faker->dateTimeThisCentury,
        'start_date' => $faker->dateTimeThisCentury,
        'probation_end_date' => $faker->dateTimeThisCentury,
        'caseload_target' => rand(0, 50),
    ];
});