<?php

use Faker\Generator as Faker;

$factory->define(TaskLoan\Task::class, function (Faker $faker) {
    return [
        'title'       => $faker->bs,
        'amount'      => $faker->randomElement([100, 200, 300, 400, 500]),
        'description' => $faker->text,
        'category'    => $faker->randomElement(['creative', 'academic', 'office']),
        'duration'    => $faker->randomElement(['1h', '3h', '6h', '1d', '2d', '3d', '4d', '1w']),
    ];
});
