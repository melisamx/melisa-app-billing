<?php 

Route::post('/', 'CustomersController@create')->middleware('gate:task.insurance.my.customers.create');
Route::delete('delete', 'CustomersController@delete')->middleware('gate:task.insurance.my.customers.delete');
Route::post('update', 'CustomersController@update')->middleware('gate:task.insurance.my.customers.update');

Route::get('/', 'CustomersController@paging')->middleware('gate:task.insurance.my.customers.paging');
Route::get('view', 'CustomersController@view')->middleware('gate:task.insurance.my.customers.view.access');
Route::get('update', 'CustomersController@update')->middleware('gate:task.insurance.my.customers.update.access');
Route::get('add', 'CustomersController@add')->middleware('gate:task.insurance.my.customers.add.access');
Route::get('report/{id}/{format}', 'CustomersController@report')->middleware('gate:task.insurance.my.customers.report');
