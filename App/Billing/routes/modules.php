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
