<?php

use App\Models\EmailTemplate;

$factory->define(EmailTemplate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->words(3, true),
        'view' => "directory.$faker->word",
    ];
});