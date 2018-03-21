<?php

$factory->define(App\CrmStatus::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
