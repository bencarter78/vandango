<?php

use App\UserManager\Groups\Group;

$factory->define(Group::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(2, true)),
        'slug' => $faker->unique()->slug(),
    ];
});