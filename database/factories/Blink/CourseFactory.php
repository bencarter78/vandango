<?php

use Carbon\Carbon;
use App\Blink\AwardingBody;
use App\Blink\Models\Course;
use App\Blink\Models\Sector;

$factory->define(Course::class, function (Faker\Generator $faker) {
    return [
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'type' => ucfirst($faker->word),
        'framework_expires_on' => Carbon::now()->addYear(),
        'title' => ucfirst($faker->words(3, true)),
        'code' => $faker->uuid,
        'description' => $faker->paragraph,
        'level' => rand(1, 7),
        'capability' => ucfirst($faker->word),
        'awarding_body_id' => function () {
            return factory(AwardingBody::class)->create()->id;
        },
        'epa_provider' => ucfirst($faker->words(3, true)),
        'aim_ref_standard' => $faker->uuid,
        'aim_ref_mandatory' => $faker->uuid,
        'aim_ref_optional' => $faker->uuid,
        'programme_length' => rand(12, 48),
        'programme_length_adult' => rand(12, 48),
        'total_training' => rand(500, 25000),
        'total_epa' => rand(500, 25000),
        'total_negotiated' => rand(500, 25000),
        'funding_band' => rand(500, 25000),
        'funding_cap' => rand(500, 25000),
        'co_investment' => rand(500, 25000),
        'employer_contribution' => rand(500, 25000),
        'additional_delivery' => rand(500, 25000),
        'total_contribution' => rand(500, 25000),
        'provider_incentive' => rand(500, 25000),
        'provider_uplift' => rand(500, 25000),
        'notes' => $faker->sentences(3, true),
    ];
});