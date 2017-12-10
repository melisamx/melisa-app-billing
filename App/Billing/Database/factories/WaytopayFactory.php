<?php

use Faker\Generator as Faker;
use App\Billing\Models\Waytopay;

$factory->define(Waytopay::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name'=>$faker->name,
        'key'=>str_slug($name),
    ];
});
