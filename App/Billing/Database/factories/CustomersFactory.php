<?php

use Faker\Generator as Faker;
use App\Core\Models\Identities;
use App\Billing\Models\Customers;
use App\Billing\Models\Repositories;
use App\Billing\Models\Contributors;
use App\Billing\Models\Waytopay;

$factory->define(Customers::class, function (Faker $faker) {
    return [
        'idRepository'=>Repositories::inRandomOrder()->first()->id,
        'idContributor'=>Contributors::inRandomOrder()->first()->id,
        'idIdentityCreated'=>Identities::inRandomOrder()->first()->id,
        'idWaytopay'=>Waytopay::inRandomOrder()->first()->id,
        'active'=>$faker->boolean,
    ];
});
