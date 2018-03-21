<?php

$factory->define(App\CrmNote::class, function (Faker\Generator $faker) {
    return [
        "customer_id" => factory('App\CrmCustomer')->create(),
        "note" => $faker->name,
    ];
});
