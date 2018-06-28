<?php

use App\Cpd\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'username' => strtolower($faker->firstName . "." . $faker->lastName),
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'password' => '$2y$10$pLnainZb9ctWKdqcHS/sb.tYvYgwu0.MiKkkNZ6niIr7sTnqJ7sle', // bcrypt('secret'),
        'remember_token' => str_random(10),
        'deleted_at' => null,
    ];
});