<?php

use App\Models\Level;
use App\Blink\Models\User;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Contact;
use App\Blink\Models\Vacancy;
use App\Models\Nas\Framework;
use App\Locations\Models\Location;
use App\UserManager\Sectors\Sector;

$factory->define(Vacancy::class, function (Faker\Generator $faker) {
    return [
        'ref' => 'NAS' . str_random(10),
        'enquiry_id' => function () {
            return factory(Enquiry::class)->create()->id;
        },
        'contact_id' => function () {
            return factory(Contact::class)->create()->id;
        },
        'location_id' => function () {
            return factory(Location::class)->create()->id;
        },
        'reo_id' => function () {
            return factory(User::class)->create()->id;
        },
        'application_manager_id' => function () {
            return factory(User::class)->create()->id;
        },
        'submitted_by' => function () {
            return factory(User::class)->create()->id;
        },
        'approved_by' => function () {
            return factory(User::class)->create()->id;
        },
        'sla_id' => rand(1, 3),
        'title' => $faker->jobTitle,
        'framework_id' => function () {
            return factory(Framework::class)->create()->id;
        },
        'qual_type' => array_rand(['Apprenticeship', 'Traineeship'], 1),
        'level_id' => function () {
            return factory(Level::class)->create()->id;
        },
        'duration' => rand(12, 48),
        'wage' => rand(4, 8),
        'sector_id' => function () {
            return factory(Sector::class)->create()->id;
        },
        'hours' => rand(30, 37),
        'working_week' => $faker->words(10, true),
        'closes_on' => $faker->dateTimeBetween('now', '+1 month'),
        'interviews_on' => $faker->dateTimeBetween('now', '+1 month'),
        'starts_on' => $faker->dateTimeBetween('now', '+1 month'),
        'positions_count' => rand(1, 100),
        'description' => $faker->words(100, true),
        'required_skills' => $faker->words(100, true),
        'required_qualifications' => $faker->words(100, true),
        'personal_qualities' => $faker->words(100, true),
        'training_provided' => $faker->words(100, true),
        'future_prospects' => $faker->words(100, true),
        'filter_applications' => $faker->boolean(),
        'considerations' => $faker->words(100, true),
        'question_1' => $faker->words(10, true) . '?',
        'question_2' => $faker->words(10, true) . '?',
        'is_visible' => $faker->boolean(),
        'application_route_url' => $faker->url,
        'organisation_description' => $faker->words(100, true),
    ];
});