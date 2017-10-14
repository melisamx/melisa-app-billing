<?php 

Route::post('/', 'RepositoriesController@create')->middleware('gate:task.billing.repositories.create');
Route::post('delete', 'RepositoriesController@delete')->middleware('gate:task.billing.repositories.delete');
Route::post('update', 'RepositoriesController@update')->middleware('gate:task.billing.repositories.update');
Route::post('activate', 'RepositoriesController@activate')->middleware('gate:task.billing.repositories.activate');
Route::post('deactivate', 'RepositoriesController@deactivate')->middleware('gate:task.billing.repositories.deactivate');
Route::get('create', 'RepositoriesController@create')->middleware('gate:task.billing.repositories.create');
Route::post('update', 'RepositoriesController@update')->middleware('gate:task.billing.repositories.update');

Route::get('/', 'RepositoriesController@paging')->middleware('gate:task.billing.repositories.paging');
Route::get('view', 'RepositoriesController@view')->middleware('gate:task.billing.repositories.view.access');
Route::get('update', 'RepositoriesController@update')->middleware('gate:task.billing.repositories.update.access');
Route::get('add', 'RepositoriesController@add')->middleware('gate:task.billing.repositories.add.access');
Route::get('report/{id}/{format?}', 'RepositoriesController@report')->middleware('gate:task.billing.repositories.report');
