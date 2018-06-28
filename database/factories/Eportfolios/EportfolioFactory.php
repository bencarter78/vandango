<?php

use App\Apply\Models\Applicant;
use App\Eportfolios\Models\Centre;
use App\Eportfolios\Models\Eportfolio;

$factory->define(Eportfolio::class, function (Faker\Generator $faker) {
    return [
        'applicant_id' => function () {
            return factory(Applicant::class)->create()->id;
        },
        'centre_id' => function () {
            return factory(Centre::class)->create()->id;
        },
        'name' => $faker->word,
        'ref' => str_random(),
        'username' => $faker->userName,
    ];
});