<?php

use App\Forum\User;
use App\Forum\Reply;
use App\Forum\Thread;

$factory->define(Reply::class, function (Faker\Generator $faker) {
    return [
        'thread_id' => function () {
            return factory(Thread::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'body' => $faker->paragraphs(5, true),
    ];
});
