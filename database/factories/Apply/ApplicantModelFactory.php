<?php

use Carbon\Carbon;
use App\Blink\Models\Enquiry;
use App\Apply\Models\Applicant;
use App\Pics\QualificationPlan;
use App\UserManager\Users\User;
use App\Apply\Models\Withdrawal;
use App\UserManager\Sectors\Sector;

$factory->define(Applicant::class, function (Faker\Generator $faker) {
    return [
        'enquiry_id' => function () {
            return factory(Enquiry::class)->create()->id;
        },
        'adviser_id' => function () {
            return factory(User::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'applicant_ident' => 'APP' . $faker->randomDigit,
        'email' => $faker->email,
        'dob' => Carbon::now()->subYears(rand(16, 50)),
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'qualification_plan_id' => function () {
            return factory(QualificationPlan::class)->create()->id;
        },
        'programme_type' => str_random(),
        'starting_on' => Carbon::now()->addDays(rand(1, 200)),
        'pics_organisation_id' => $faker->uuid,
        'organisation_name' => $faker->company,
        'contact_email' => $faker->companyEmail,
        'contact_first_name' => $faker->firstName,
        'contact_surname' => $faker->lastName,
    ];
});

$factory->state(Applicant::class, 'unassigned', function (Faker\Generator $faker) {
    return [
        'adviser_id' => null,
    ];
});

$factory->state(Applicant::class, 'withdrawn', function (Faker\Generator $faker) {
    return [
        'withdrawal_id' => function () {
            return factory(Withdrawal::class)->create()->id;
        },
    ];
});

$factory->state(Applicant::class, 'identified', function (Faker\Generator $faker) {
    return [
        'episode_ident' => null,
        'started_on' => null,
        'received_at' => null,
    ];
});

$factory->state(Applicant::class, 'start', function (Faker\Generator $faker) {
    return [
        'episode_ident' => 'START' . $faker->randomDigit,
        'started_on' => Carbon::yesterday(),
        'received_at' => Carbon::tomorrow(),
    ];
});