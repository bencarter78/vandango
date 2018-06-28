<?php

use App\Judi\Models\Grade;
use App\Judi\Models\Report;
use App\Judi\Models\Summary;
use App\Judi\Models\Assessment;

$factory->define(Summary::class, function (\Faker\Generator $faker) {
    return [
        'assessment_id' => function () {
            return factory(Assessment::class)->create()->id;
        },
        'report_id' => function () {
            return factory(Report::class)->create()->id;
        },
        'grade_id' => function () {
            return factory(Grade::class)->create()->id;
        },
        'assessment_date' => $faker->dateTimeThisYear,
        'document_path' => $faker->text(40),
        'outcome' => null,
    ];
});