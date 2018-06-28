<?php

use App\Forum\User;
use App\Forum\Thread;
use App\Forum\Channel;

$factory->define(Thread::class, function (Faker\Generator $faker) {
    return [
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => ucwords($faker->unique()->words(5, true)),
        'body' => $faker->paragraphs(5, true),
    ];
});
