<?php

use App\Pics\QualificationPlan;
use App\UserManager\Sectors\Sector;

$factory->define(QualificationPlan::class, function (Faker\Generator $faker) {
    return [
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'code' => $faker->word,
        'description' => $faker->sentence,
        'framework' => $faker->word,
        'framework_path' => $faker->word,
        'main_aim' => $faker->word,
        'main_aim_description' => $faker->sentence,
    ];
});