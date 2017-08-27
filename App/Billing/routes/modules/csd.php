<?php 

Route::post('/', 'CsdController@create')->middleware('gate:task.billing.csd.create');
Route::post('delete', 'CsdController@delete')->middleware('gate:task.billing.csd.delete');

Route::get('/', 'CsdController@paging')->middleware('gate:task.billing.csd.paging');
Route::get('view', 'CsdController@view')->middleware('gate:task.billing.csd.view.access');
Route::get('add', 'CsdController@add')->middleware('gate:task.billing.csd.add.access');
Route::get('report/{id}/{format?}', 'CsdController@report')->middleware('gate:task.billing.csd.report');
