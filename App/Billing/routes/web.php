<?php 

Route::group([
    'prefix'=>'my',
    'namespace' =>'My',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/my.php');    
});

Route::group([
    'prefix'=>'reports',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/reports.php');    
});

Route::group([
    'prefix'=>'providers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/providers.php');    
});

Route::group([
    'prefix'=>'modules',
    'namespace'=>'Modules'
], function() {    
    require realpath(base_path() . '/routes/modules.php');    
});

Route::group([
    'prefix'=>'cfdi',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/cfdi.php');    
});

Route::group([
    'prefix'=>'bankAccounts',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/bankAccounts.php');    
});

Route::group([
    'prefix'=>'referralNotes',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/referralNotes.php');    
});

Route::group([
    'prefix'=>'documents',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/documents.php');    
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
    'prefix'=>'accountsReceivable',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/accountsReceivable.php');    
});

Route::group([
    'prefix'=>'csd',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/csd.php');    
});

Route::group([
    'prefix'=>'paymentMethods',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/paymentMethods.php');    
});

Route::group([
    'prefix'=>'waytopay',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/waytopay.php');    
});

Route::group([
    'prefix'=>'coins',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/coins.php');    
});

Route::group([
    'prefix'=>'banks',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/banks.php');    
});

Route::group([
    'prefix'=>'exchangeRates',
    'middleware'=>'auth',
], function() {
    require realpath(base_path() . '/routes/modules/exchangeRates.php');    
});

Route::group([
    'prefix'=>'customers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customers.php');    
});

Route::group([
    'prefix'=>'customersContacts',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customersContacts.php');    
});

Route::group([
    'prefix'=>'customersAddresses',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customersAddresses.php');    
});

Route::group([
    'prefix'=>'customersBanksAccounts',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customersBanksAccounts.php');    
});

Route::group([
    'prefix'=>'customerGroups',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroups.php');    
});

Route::group([
    'prefix'=>'customerGroupsCustomers',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroupsCustomers.php');    
});

Route::group([
    'prefix'=>'customerGroupsIdentities',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroupsIdentities.php');    
});

Route::group([
    'prefix'=>'repositories',
    'middleware'=>'auth',
], function() {    
    require realpath(base_path() . '/routes/modules/repositories.php');    
});
