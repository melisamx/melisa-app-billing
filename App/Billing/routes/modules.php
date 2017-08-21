<?php 

Route::group([
    'prefix'=>'invoice',
], function() {    
    require realpath(base_path() . '/routes/modules/invoice.php');    
});

Route::group([
    'prefix'=>'series',
], function() {    
    require realpath(base_path() . '/routes/modules/series.php');    
});

Route::group([
    'prefix'=>'accounts',
], function() {    
    require realpath(base_path() . '/routes/modules/accounts.php');    
});

Route::group([
    'prefix'=>'debtsToPay',
], function() {    
    require realpath(base_path() . '/routes/modules/debtsToPay.php');    
});
