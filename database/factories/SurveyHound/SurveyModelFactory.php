<?php

$factory->define(\App\SurveyHound\Survey::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->words(3, true),
        'description' => $faker->sentences(2, true),
        'frequency' => array_rand(['minute', 'day', 'week', 'month', 'year']),
        'subject' => $faker->words(5, true),
        'message' => $faker->sentences(5, true),
        'sql' => $faker->text(),
    ];
});