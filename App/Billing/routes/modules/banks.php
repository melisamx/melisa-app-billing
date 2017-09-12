<?php 

Route::post('/', 'BanksController@create')->middleware('gate:task.insurance.banks.create');
Route::post('delete', 'BanksController@delete')->middleware('gate:task.insurance.banks.delete');
Route::post('update', 'BanksController@update')->middleware('gate:task.insurance.banks.update');
Route::post('activate', 'BanksController@activate')->middleware('gate:task.insurance.banks.activate');
Route::post('deactivate', 'BanksController@deactivate')->middleware('gate:task.insurance.banks.deactivate');
Route::get('create', 'BanksController@create')->middleware('gate:task.insurance.banks.create');
Route::post('update', 'BanksController@update')->middleware('gate:task.insurance.banks.update');

Route::get('/', 'BanksController@paging')->middleware('gate:task.insurance.banks.paging');
Route::get('view', 'BanksController@view')->middleware('gate:task.insurance.banks.view.access');
Route::get('update', 'BanksController@update')->middleware('gate:task.insurance.banks.update.access');
Route::get('add', 'BanksController@add')->middleware('gate:task.insurance.banks.add.access');
Route::get('report/{id}/{format?}', 'BanksController@report')->middleware('gate:task.insurance.banks.report');
