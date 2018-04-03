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
    'namespace'=>'v1',
    'middleware'=>'auth:api',
], function() {
    Route::group([
        'prefix'=>'typesFactor',
    ], function() {
        require realpath(base_path() . '/routes/modules/typesFactor.php');    
    });
    Route::group([
        'prefix'=>'taxActions',
    ], function() {
        require realpath(base_path() . '/routes/modules/taxActions.php');    
    });
    Route::group([
        'prefix'=>'taxes',
    ], function() {
        require realpath(base_path() . '/routes/modules/taxes.php');    
    });
    Route::group([
        'prefix'=>'conceptUnits',
    ], function() {
        require realpath(base_path() . '/routes/modules/conceptUnits.php');    
    });
    Route::group([
        'prefix'=>'conceptKeys',
    ], function() {
        require realpath(base_path() . '/routes/modules/conceptKeys.php');    
    });
    Route::group([
        'prefix'=>'useCfdi',
    ], function() {
        require realpath(base_path() . '/routes/modules/useCfdi.php');    
    });
    Route::group([
        'prefix'=>'paymentMethods',
    ], function() {
        require realpath(base_path() . '/routes/modules/paymentMethods.php');    
    });
    Route::group([
        'prefix'=>'waytopay',
    ], function() {
        require realpath(base_path() . '/routes/modules/waytopay.php');    
    });
    Route::group([
        'prefix'=>'coins',
    ], function() {
        require realpath(base_path() . '/routes/modules/coins.php');    
    });
    Route::group([
        'prefix'=>'series',
    ], function() {
        require realpath(base_path() . '/routes/modules/series.php');    
    });
    Route::group([
        'prefix'=>'documents',
    ], function() {
        require realpath(base_path() . '/routes/modules/documents.php');    
    });
    Route::group([
        'prefix'=>'customers',
    ], function() {
        require realpath(base_path() . '/routes/modules/customers_api.php');    
    });
    Route::group([
        'prefix'=>'concepts',
    ], function() {
        require realpath(base_path() . '/routes/modules/concepts.php');    
    });
});
