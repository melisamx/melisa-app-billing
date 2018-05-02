<?php 

Route::group([
    'prefix'=>'customers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/customers.php');    
});

Route::group([
    'prefix'=>'customersAddresses',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/customersAddresses.php');    
});
