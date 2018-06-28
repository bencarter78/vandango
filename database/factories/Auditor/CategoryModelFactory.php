<?php

use App\Auditor\Categories\Category;

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->words(3, true),
    ];
});