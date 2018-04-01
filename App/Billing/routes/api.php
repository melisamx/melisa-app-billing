<?php 

Route::group([
    'prefix'=>'v1',
    'middleware'=>'auth.basic',
    'namespace' =>'v1'
], function() {
    Route::group([
        'prefix'=>'accountsReceivable',
    ], function() {
        require realpath(base_path() . '/routes/modules/accountsReceivable.php');    
    });
});

Route::group([
    'prefix'=>'v1',
    'namespace'=>'v1'
], function() {
    Route::get('series', 'SeriesController@paging');
});
