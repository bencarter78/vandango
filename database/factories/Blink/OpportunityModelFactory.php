<?php

use Carbon\Carbon;
use App\Blink\Models\User;
use App\Blink\Models\Sector;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Opportunity;

$factory->define(Opportunity::class, function (Faker\Generator $faker) {
    return [
        'enquiry_id' => function () {
            return factory(Enquiry::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'quantity' => random_int(1, 100),
        'value' => random_int(500, 20000),
        'expected_on' => Carbon::now()->addDays(rand(1, 200)),
        'programme_type' => $faker->words(2, true),
    ];
});
