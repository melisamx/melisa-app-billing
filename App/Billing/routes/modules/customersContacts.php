<?php 

Route::post('/', 'CustomersContactsController@create')->middleware('gate:task.billing.customersContacts.create');
Route::post('delete', 'CustomersContactsController@delete')->middleware('gate:task.billing.customersContacts.delete');
Route::post('update', 'CustomersContactsController@update')->middleware('gate:task.billing.customersContacts.update');

Route::get('/', 'CustomersContactsController@paging')->middleware('gate:task.billing.customersContacts.paging');
Route::get('view', 'CustomersContactsController@view')->middleware('gate:task.billing.customersContacts.view.access');
Route::get('update', 'CustomersContactsController@update')->middleware('gate:task.billing.customersContacts.update.access');
Route::get('add', 'CustomersContactsController@add')->middleware('gate:task.billing.customersContacts.add.access');
Route::get('report/{id}/{format}', 'CustomersContactsController@report')->middleware('gate:task.billing.customersContacts.report');
