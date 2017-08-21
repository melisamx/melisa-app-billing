<?php 

Route::group([
    'prefix'=>'modules',
    'namespace'=>'Modules'
], function() {    
    require realpath(base_path() . '/routes/modules.php');    
});

Route::group([
    'prefix'=>'invoice',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/invoice.php');    
});

Route::group([
    'prefix'=>'series',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/series.php');    
});

Route::group([
    'prefix'=>'debtsToPay',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/debtsToPay.php');    
});

Route::group([
    'prefix'=>'accounts',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/accounts.php');    
});

Route::group([
    'prefix'=>'accountsReceivable',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/accountsReceivable.php');    
});
