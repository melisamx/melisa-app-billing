<?php 

Route::post('/', 'CustomerGroupsCustomersController@create')
    ->middleware('gate:task.insurance.customerGroupsCustomers.create');
Route::post('delete', 'CustomerGroupsCustomersController@delete')
    ->middleware('gate:task.insurance.customerGroupsCustomers.delete');
Route::post('update', 'CustomerGroupsCustomersController@update')
    ->middleware('gate:task.insurance.customerGroupsCustomers.update');
Route::post('activate', 'CustomerGroupsCustomersController@activate')
    ->middleware('gate:task.insurance.customerGroupsCustomers.activate');
Route::post('deactivate', 'CustomerGroupsCustomersController@deactivate')
    ->middleware('gate:task.insurance.customerGroupsCustomers.deactivate');

Route::get('/', 'CustomerGroupsCustomersController@paging')
    ->middleware('gate:task.insurance.customerGroupsCustomers.paging');
Route::get('view', 'CustomerGroupsCustomersController@view')
    ->middleware('gate:task.insurance.customerGroupsCustomers.view.access');
Route::get('update', 'CustomerGroupsCustomersController@update')
    ->middleware('gate:task.insurance.customerGroupsCustomers.update.access');
Route::get('add', 'CustomerGroupsCustomersController@add')
    ->middleware('gate:task.insurance.customerGroupsCustomers.add.access');
Route::get('report/{id}/{format}', 'CustomerGroupsCustomersController@report')
    ->middleware('gate:task.insurance.customerGroupsCustomers.report');
