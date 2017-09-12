<?php 

Route::get('/', 'PaymentMethodsController@paging')->middleware('gate:task.billing.paymentMethods.paging');
Route::get('view', 'CustomersController@view')->middleware('gate:task.billing.paymentMethods.view.access');
Route::get('update', 'CustomersController@update')->middleware('gate:task.billing.paymentMethods.update.access');
Route::get('add', 'CustomersController@add')->middleware('gate:task.billing.paymentMethods.add.access');
Route::get('report/{id}/{format}', 'CustomersController@report')->middleware('gate:task.billing.paymentMethods.report');
