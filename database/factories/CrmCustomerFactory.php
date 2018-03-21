<?php

$factory->define(App\CrmCustomer::class, function (Faker\Generator $faker) {
    return [
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "crm_status_id" => factory('App\CrmStatus')->create(),
        "email" => $faker->safeEmail,
        "phone" => $faker->name,
        "address" => $faker->name,
        "skype" => $faker->name,
        "website" => $faker->name,
        "description" => $faker->name,
    ];
});
