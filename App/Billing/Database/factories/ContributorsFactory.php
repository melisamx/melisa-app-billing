<?php

use Faker\Generator as Faker;
use App\Core\Models\Identities;
use App\Billing\Models\Contributors;
use App\Billing\Models\FiscalRegime;

$factory->define(Contributors::class, function (Faker $faker) {
    return [
        'idFiscalRegime'=>FiscalRegime::inRandomOrder()->first()->id,
        'idIdentityCreated'=>Identities::inRandomOrder()->first()->id,
        'rfc'=>strtoupper($faker->bothify('????######?##')),
        'name'=>$faker->name,
        'active'=>$faker->boolean,
        'email'=>$faker->email,
    ];
});
