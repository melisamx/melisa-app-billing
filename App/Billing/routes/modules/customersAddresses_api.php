<?php 

Route::post('/', 'CustomersAddressesController@create')
    ->middleware('gate:task.insurance.customersAddresses.create');
Route::get('/', 'CustomersAddressesController@paging')
    ->middleware('gate:task.insurance.customersAddresses.paging');