<?php 

Route::post('/', 'CustomersAddressesController@create')
    ->middleware('gate:task.insurance.customersAddresses.create');
Route::post('delete', 'CustomersAddressesController@delete')
    ->middleware('gate:task.insurance.customersAddresses.delete');
Route::post('update', 'CustomersAddressesController@update')
    ->middleware('gate:task.insurance.customersAddresses.update');
Route::post('activate', 'CustomersAddressesController@activate')
    ->middleware('gate:task.insurance.customersAddresses.activate');
Route::post('deactivate', 'CustomersAddressesController@deactivate')
    ->middleware('gate:task.insurance.customersAddresses.deactivate');

Route::get('/', 'CustomersAddressesController@paging')
    ->middleware('gate:task.insurance.customersAddresses.paging');
Route::get('view', 'CustomersAddressesController@view')
    ->middleware('gate:task.insurance.customersAddresses.view.access');
Route::get('update', 'CustomersAddressesController@update')
    ->middleware('gate:task.insurance.customersAddresses.update.access');
Route::get('add', 'CustomersAddressesController@add')
    ->middleware('gate:task.insurance.customersAddresses.add.access');
Route::get('report/{id}/{format}', 'CustomersAddressesController@report')
    ->middleware('gate:task.insurance.customersAddresses.report');
