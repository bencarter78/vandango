<?php

use App\Blink\Models\Organisation;
use App\Locations\Models\Location;

$factory->define(Organisation::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'tel' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'twitter' => strtolower("@{$faker->word}"),
        'website' => $faker->url,
        'datastore_ref' => strtoupper(str_random(5)),
        'employee_count' => random_int(1, 100000),
        'site_count' => random_int(1, 100000),
        'legal_status' => $faker->word,
        'levy_pot' => random_int(1000, 10000000),
        'edrs' => strtoupper(str_random(10)),
    ];
});

$factory->state(Organisation::class, 'unmatched', function (Faker\Generator $faker) {
    return [
        'datastore_ref' => null,
        'edrs' => null,
    ];
});

$factory->state(Organisation::class, 'aliased', function (Faker\Generator $faker) {
    return [
        'alias' => $faker->company,
    ];
});

$factory->state(Organisation::class, 'hasHeadquarters', function (Faker\Generator $faker) {
    return [
        'hq_id' => function () {
            return factory(Location::class)->create()->id;
        },
    ];
});
