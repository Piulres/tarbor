<?php

$factory->define(App\TimeEntry::class, function (Faker\Generator $faker) {
    return [
        "work_type_id" => factory('App\TimeWorkType')->create(),
        "project_id" => factory('App\TimeProject')->create(),
        "start_time" => $faker->date("d/m/Y H:i:s", $max = 'now'),
        "end_time" => $faker->date("d/m/Y H:i:s", $max = 'now'),
    ];
});
