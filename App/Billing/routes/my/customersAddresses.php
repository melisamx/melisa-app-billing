<?php 

Route::post('/', 'CustomersAddressesController@create')->middleware('gate:task.insurance.my.customersAddresses.create');
Route::post('delete', 'CustomersAddressesController@delete')->middleware('gate:task.insurance.my.customersAddresses.delete');
Route::post('update', 'CustomersAddressesController@update')->middleware('gate:task.insurance.my.customersAddresses.update');

Route::get('/', 'CustomersAddressesController@paging')->middleware('gate:task.insurance.my.customersAddresses.paging');
Route::get('view', 'CustomersAddressesController@view')->middleware('gate:task.insurance.my.customersAddresses.view.access');
Route::get('update', 'CustomersAddressesController@update')->middleware('gate:task.insurance.my.customersAddresses.update.access');
Route::get('add', 'CustomersAddressesController@add')->middleware('gate:task.insurance.my.customersAddresses.add.access');
Route::get('report/{id}/{format}', 'CustomersAddressesController@report')->middleware('gate:task.insurance.my.customersAddresses.report');
