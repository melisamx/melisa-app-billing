<?php 

Route::get('/', 'CustomersController@paging')->middleware('gate:task.billing.customers.paging');

Route::group([
    'prefix'=>'{id}/addresses'
], function() {
    require realpath(base_path() . '/routes/modules/customersAddresses_api.php');  
});