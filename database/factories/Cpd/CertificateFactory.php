<?php

use App\Cpd\User;
use Carbon\Carbon;
use App\Cpd\Certificate;

$factory->define(Certificate::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => ucwords($faker->words(3, true)),
        'achieved_on' => Carbon::now(),
        'expires_on' => Carbon::now()->addMonth(),
        'path' => 'path/to/my/file',
    ];
});