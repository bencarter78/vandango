<?php

use App\Blink\Models\Sector;
use App\Blink\Models\Department;

$factory->define(Sector::class, function (Faker\Generator $faker) {
    return [
        'code' => 'OM' . $faker->numberBetween(100, 999),
        'name' => ucwords($faker->unique()->words(2, true)),
        'department_id' => function () {
            return factory(Department::class)->create()->id;
        },
    ];
});
