<?php

use App\Auditor\Tasks\Task;
use App\Auditor\Categories\Category;

$factory->define(Task::class, function (Faker\Generator $faker) {
    return [
        'category_id' => factory(Category::class)->create()->id,
        'title' => ucwords($faker->words(3, true)),
        'description' => $faker->sentences(2, true),
        'sql' => $faker->text(),
        'recipients' => $faker->email,
        'notification' => $faker->sentences(5, true),
        'run_frequency' => array_rand(['minute', 'day', 'week', 'month', 'year']),
    ];
});