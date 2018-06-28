<?php

use App\Blink\Models\Enquiry;
use App\Blink\Models\Contact;
use App\Blink\Models\Referrer;

$factory->define(Enquiry::class, function (Faker\Generator $faker) {
    return [
        'contact_id' => function () {
            return factory(Contact::class)->create()->id;
        },
        'location' => $faker->city,
        'employee_count' => $faker->numberBetween(1, 999),
        'projected_value' => $faker->numberBetween(1500, 1000000),
        'actual_value' => $faker->numberBetween(1500, 1000000),
        'referrer_id' => function () {
            return factory(Referrer::class)->create()->id;
        },
    ];
});