<?php 

Route::post('/', 'ProvidersController@create')->middleware('gate:task.billing.providers.create');
Route::post('delete', 'ProvidersController@delete')->middleware('gate:task.billing.providers.delete');
Route::post('update', 'ProvidersController@update')->middleware('gate:task.billing.providers.update');
Route::post('activate', 'ProvidersController@activate')->middleware('gate:task.billing.providers.activate');
Route::post('deactivate', 'ProvidersController@deactivate')->middleware('gate:task.billing.providers.deactivate');
Route::get('create', 'ProvidersController@create')->middleware('gate:task.billing.providers.create');
Route::post('update', 'ProvidersController@update')->middleware('gate:task.billing.providers.update');

Route::get('/', 'ProvidersController@paging')->middleware('gate:task.billing.providers.paging');
Route::get('view', 'ProvidersController@view')->middleware('gate:task.billing.providers.view.access');
Route::get('update', 'ProvidersController@update')->middleware('gate:task.billing.providers.update.access');
Route::get('add', 'ProvidersController@add')->middleware('gate:task.billing.providers.add.access');
Route::get('report/{id}/{format?}', 'ProvidersController@report')->middleware('gate:task.billing.providers.report');