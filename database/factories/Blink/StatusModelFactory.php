<?php

use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Blink\Models\Enquiry;

$factory->define(Status::class, function (Faker\Generator $faker) {
    return [
        'type' => collect(['Live', 'Completed'])->random(),
        'name' => $faker->words(3, true),
        'owner' => Enquiry::class,
        'order' => random_int(1, 10),
    ];
});

$factory->state(Status::class, 'live', function (Faker\Generator $faker) {
    return [
        'type' => 'live',
    ];
});

$factory->state(Status::class, 'completed', function (Faker\Generator $faker) {
    return [
        'type' => 'completed',
    ];
});

// Enquiry Statuses
$factory->state(Status::class, 'enquiry', function (Faker\Generator $faker) {
    return [
        'owner' => Enquiry::class,
    ];
});

$factory->state(Status::class, 'draft', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.vacancy-saved'),
    ];
});

$factory->state(Status::class, 'pending', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.vacancy-pending'),
    ];
});

$factory->state(Status::class, 'unqualified', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.unqualified'),
    ];
});

$factory->state(Status::class, 'qualified', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.qualified'),
    ];
});


// Vacancy Statuses
$factory->state(Status::class, 'vacancy', function (Faker\Generator $faker) {
    return [
        'owner' => Vacancy::class,
    ];
});

$factory->state(Status::class, 'on-nas', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.vacancy-live'),
    ];
});

$factory->state(Status::class, 'published', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.vacancy-live'),
    ];
});

$factory->state(Status::class, 'closed', function (Faker\Generator $faker) {
    return [
        'name' => config('vandango.blink.statuses.vacancy-closed'),
    ];
});