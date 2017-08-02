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
