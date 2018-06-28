<?php


use App\Blink\AwardingBody;

$factory->define(AwardingBody::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
    ];
});