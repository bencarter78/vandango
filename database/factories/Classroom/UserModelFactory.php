<?php

use App\Classroom\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'username' => strtolower($faker->firstName . "." . $faker->lastName),
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
        'deleted_at' => null,
    ];
});