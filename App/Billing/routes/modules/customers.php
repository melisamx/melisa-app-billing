<?php 

Route::post('/', 'CustomersController@create')->middleware('gate:task.billing.customers.create');
Route::post('delete', 'CustomersController@delete')->middleware('gate:task.billing.customers.delete');
Route::delete('/', 'CustomersController@delete')->middleware('gate:task.billing.customers.delete');
Route::post('update', 'CustomersController@update')->middleware('gate:task.billing.customers.update');
Route::post('activate', 'CustomersController@activate')->middleware('gate:task.billing.customers.activate');
Route::post('deactivate', 'CustomersController@deactivate')->middleware('gate:task.billing.customers.deactivate');

Route::get('/', 'CustomersController@paging')->middleware('gate:task.billing.customers.paging');
Route::get('view', 'CustomersController@view')->middleware('gate:task.billing.customers.view.access');
Route::get('update', 'CustomersController@update')->middleware('gate:task.billing.customers.update.access');
Route::get('add', 'CustomersController@add')->middleware('gate:task.billing.customers.add.access');
Route::get('report/{id}/{format}', 'CustomersController@report')->middleware('gate:task.billing.customers.report');
