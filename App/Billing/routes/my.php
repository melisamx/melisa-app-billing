<?php 

Route::group([
    'prefix'=>'insuranceApplications',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/insuranceApplications.php');    
});

Route::group([
    'prefix'=>'insured',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/insured.php');    
});

Route::group([
    'prefix'=>'customers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/customers.php');    
});
