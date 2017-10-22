<?php

use Faker\Generator as Faker;
use App\Core\Models\Identities;
use App\Billing\Models\Contributors;

$factory->define(Contributors::class, function (Faker $faker) {
    return [
        'idIdentityCreated'=>Identities::inRandomOrder()->first()->id,
        'rfc'=>strtoupper($faker->bothify('????######?##')),
        'name'=>$faker->name,
        'active'=>$faker->boolean,
        'email'=>$faker->email,
    ];
});
