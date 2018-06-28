<?php

use App\Blink\Models\User;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Activity;

$factory->define(Activity::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => function () {
            return factory(Enquiry::class)->create()->id;
        },
        'owner_type' => Enquiry::class,
        'assigned_by' => function () {
            return factory(User::class)->create()->id;
        },
        'assigned_to' => function () {
            return factory(User::class)->create()->id;
        },
        'due_at' => $faker->dateTimeThisCentury,
        'is_complete' => $faker->boolean,
        'note' => $faker->paragraph(10),
    ];
});