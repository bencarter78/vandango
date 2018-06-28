<?php

use App\UserManager\Users\User;
use App\UserManager\Departments\Department;

$factory->define(Department::class, function (Faker\Generator $faker) {
    return [
        'department' => $faker->words(2, true),
        'manager_id' => function () {
            return factory(User::class)->create()->id;
        },
        'ad_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
