<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(TaskLoan\User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email_verified_at' => now(),
        'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'    => str_random(10),
        'mobile_number'     => '0917' . str_pad(rand(0, 9999999), 7, 0, STR_PAD_LEFT),
        'address'           => 'Manila, Philippines',
    ];
});

$factory->state(TaskLoan\User::class, 'taskmaster-role', [
    'email' => 'taskmaster@taskloan.pro',
    'role'        => 'taskmaster',
    'verified_at' => now()
]);

$factory->state(TaskLoan\User::class, 'student-role', [
    'email' => 'student@taskloan.pro',
    'role'   => 'student',
    'school' => 'Polytechnic University of the Philippines'
]);
