<?php 

Route::group([
    'prefix'=>'bankAccounts',
], function() {    
    require realpath(base_path() . '/routes/modules/bankAccounts.php');    
});

Route::group([
    'prefix'=>'cfdi',
], function() {    
    require realpath(base_path() . '/routes/modules/cfdi.php');    
});

Route::group([
    'prefix'=>'customers',
], function() {    
    require realpath(base_path() . '/routes/modules/customers.php');    
});

Route::group([
    'prefix'=>'documents',
], function() {    
    require realpath(base_path() . '/routes/modules/documents.php');    
});

Route::group([
    'prefix'=>'series',
], function() {    
    require realpath(base_path() . '/routes/modules/series.php');    
});

Route::group([
    'prefix'=>'debtsToPay',
], function() {    
    require realpath(base_path() . '/routes/modules/debtsToPay.php');    
});

Route::group([
    'prefix'=>'accountsReceivable',
], function() {    
    require realpath(base_path() . '/routes/modules/accountsReceivable.php');    
});

Route::group([
    'prefix'=>'csd',
], function() {    
    require realpath(base_path() . '/routes/modules/csd.php');    
});

Route::group([
    'prefix'=>'banks',
], function() {    
    require realpath(base_path() . '/routes/modules/banks.php');    
});

Route::group([
    'prefix'=>'exchangeRates',
], function() {    
    require realpath(base_path() . '/routes/modules/exchangeRates.php');    
});

Route::group([
    'prefix'=>'referralNotes',
], function() {    
    require realpath(base_path() . '/routes/modules/referralNotes.php');    
});

Route::group([
    'prefix'=>'customersBanksAccounts',
], function() {    
    require realpath(base_path() . '/routes/modules/customersBanksAccounts.php');    
});

Route::group([
    'prefix'=>'customerGroups',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroups.php');    
});

Route::group([
    'prefix'=>'customersAddresses',
], function() {    
    require realpath(base_path() . '/routes/modules/customersAddresses.php');    
});

Route::group([
    'prefix'=>'customerGroupsCustomers',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroupsCustomers.php');    
});

Route::group([
    'prefix'=>'customerGroupsIdentities',
], function() {    
    require realpath(base_path() . '/routes/modules/customerGroupsIdentities.php');    
});

Route::group([
    'prefix'=>'customersContacts',
], function() {    
    require realpath(base_path() . '/routes/modules/customersContacts.php');    
});

Route::group([
    'prefix'=>'repositories',
], function() {    
    require realpath(base_path() . '/routes/modules/repositories.php');    
});