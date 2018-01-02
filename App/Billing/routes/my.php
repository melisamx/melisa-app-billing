<?php 

Route::group([
    'prefix'=>'customers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my/customers.php');    
});
