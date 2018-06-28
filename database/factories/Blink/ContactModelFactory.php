<?php

use App\Blink\Models\Contact;
use App\Blink\Models\Organisation;

$factory->define(Contact::class, function (Faker\Generator $faker) {
    return [
        'organisation_id' => function () {
            return factory(Organisation::class)->create()->id;
        },
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'tel' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'job_title' => $faker->jobTitle,
    ];
});
