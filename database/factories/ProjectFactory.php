<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2, true),
        'description' => $faker->paragraph(2, true),
        'owner_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
