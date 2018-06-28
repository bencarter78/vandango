<?php

use App\UserManager\Roles\Role;

$factory->define(Role::class, function (Faker\Generator $faker) {
    return [
        'job_role' => ucwords($faker->words(2, true)),
    ];
});