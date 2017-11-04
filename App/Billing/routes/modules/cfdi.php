<?php 

Route::post('/', 'CfdiController@create')->middleware('gate:task.billing.cfdi.create');

Route::get('/', 'CfdiController@paging')->middleware('gate:task.billing.cfdi.paging');
Route::get('add', 'CfdiController@add')->middleware('gate:task.billing.cfdi.add.access');
Route::get('report/{id}/{format?}', 'CfdiController@report')->middleware('gate:task.billing.cfdi.report');
