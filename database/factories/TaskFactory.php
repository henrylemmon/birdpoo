<?php

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(),
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
        'completed' => false
    ];
});
