<?php 

Route::post('/', 'BanksController@create')->middleware('gate:task.billing.banks.create');
Route::post('delete', 'BanksController@delete')->middleware('gate:task.billing.banks.delete');
Route::post('update', 'BanksController@update')->middleware('gate:task.billing.banks.update');
Route::post('activate', 'BanksController@activate')->middleware('gate:task.billing.banks.activate');
Route::post('deactivate', 'BanksController@deactivate')->middleware('gate:task.billing.banks.deactivate');
Route::get('create', 'BanksController@create')->middleware('gate:task.billing.banks.create');
Route::post('update', 'BanksController@update')->middleware('gate:task.billing.banks.update');

Route::get('/', 'BanksController@paging')->middleware('gate:task.billing.banks.paging');
Route::get('view', 'BanksController@view')->middleware('gate:task.billing.banks.view.access');
Route::get('update', 'BanksController@update')->middleware('gate:task.billing.banks.update.access');
Route::get('add', 'BanksController@add')->middleware('gate:task.billing.banks.add.access');
Route::get('report/{id}/{format?}', 'BanksController@report')->middleware('gate:task.billing.banks.report');
