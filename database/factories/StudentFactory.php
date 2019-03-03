<?php

use Faker\Generator as Faker;

$factory->define(App\model\Student::class, function (Faker $faker) {
    return [
        'name'=> $fakerker->word,
        'email' =>$faker->unique()->safeEmail,
        'phone' =>$faker->unique()->phoneNumber,
    ];
});
