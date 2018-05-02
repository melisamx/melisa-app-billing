<?php 

Route::post('/', 'CustomersAddressesController@create')
    ->middleware('gate:task.api.insurance.customersAddresses.create');
Route::get('/', 'CustomersAddressesController@paging')
    ->middleware('gate:task.api.insurance.customersAddresses.paging');