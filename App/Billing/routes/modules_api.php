<?php

Route::group([
    'prefix'=>'exchangeRates',
], function() {    
    require realpath(base_path() . '/routes/modules/exchangeRates.php');    
});
