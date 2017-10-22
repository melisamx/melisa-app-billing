<?php

use Faker\Generator as Faker;
use App\Core\Models\Identities;
use App\Billing\Models\Contributors;
use App\Billing\Models\ContributorsAddresses;
use App\People\Models\Countries;
use App\People\Models\States;
use App\People\Models\Municipalities;

$factory->define(ContributorsAddresses::class, function (Faker $faker) {
    return [
        'idIdentityCreated'=>Identities::inRandomOrder()->first()->id,
        'idContributor'=>Contributors::inRandomOrder()->first()->id,
        'idCountry'=>Countries::inRandomOrder()->first()->id,
        'idState'=>States::inRandomOrder()->first()->id,
        'idMunicipality'=>Municipalities::inRandomOrder()->first()->id,
        'address'=>$faker->address,
        'colony'=>$faker->streetName,
        'postalCode'=>$faker->postcode,
        'exteriorNumber'=>$faker->randomDigitNotNull,
        'interiorNumber'=>$faker->randomDigit,
        'isDefault'=>$faker->boolean,
    ];
});
