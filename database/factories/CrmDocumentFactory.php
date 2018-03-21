<?php

$factory->define(App\CrmDocument::class, function (Faker\Generator $faker) {
    return [
        "customer_id" => factory('App\CrmCustomer')->create(),
        "name" => $faker->name,
        "description" => $faker->name,
    ];
});
