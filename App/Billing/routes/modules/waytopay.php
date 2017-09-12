<?php 

Route::get('/', 'WaytopayController@paging')->middleware('gate:task.billing.waytopay.paging');
Route::get('view', 'WaytopayController@view')->middleware('gate:task.billing.waytopay.view.access');
Route::get('update', 'WaytopayController@update')->middleware('gate:task.billing.waytopay.update.access');
Route::get('add', 'WaytopayController@add')->middleware('gate:task.billing.waytopay.add.access');
Route::get('report/{id}/{format}', 'WaytopayController@report')->middleware('gate:task.billing.waytopay.report');
