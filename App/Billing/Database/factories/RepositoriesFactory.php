<?php

use Faker\Generator as Faker;
use App\Core\Models\Identities;
use App\Billing\Models\Repositories;

$factory->define(Repositories::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'idIdentityCreated'=>Identities::inRandomOrder()->first()->id,
        'name'=>$name,
        'active'=>$faker->boolean,
        'expirationDays'=>$faker->numberBetween(30, 90),
    ];
});
