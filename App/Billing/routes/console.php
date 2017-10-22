<?php

Artisan::command('fake', function () {
    app(App\Billing\Logics\Fake\AllLogic::class)->init([
        'limit'=>10
    ]);
})->describe('Fake data on database');

Artisan::command('clean', function () {
    app(App\Billing\Logics\Database\CleanLogic::class)->init([
        'limit'=>10
    ]);
})->describe('Clean database');
