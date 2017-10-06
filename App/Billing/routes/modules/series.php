<?php

Route::post('/', 'SeriesController@create')->middleware('gate:task.billing.series.create');
Route::post('delete', 'SeriesController@delete')->middleware('gate:task.billing.series.delete');
Route::post('update', 'SeriesController@update')->middleware('gate:task.billing.series.update');
Route::post('activate', 'SeriesController@activate')->middleware('gate:task.billing.series.activate');
Route::post('deactivate', 'SeriesController@deactivate')->middleware('gate:task.billing.series.deactivate');

Route::get('/', 'SeriesController@paging')->middleware('gate:task.billing.series.paging');
Route::get('view', 'SeriesController@view')->middleware('gate:task.billing.series.view.access');
Route::get('add', 'SeriesController@add')->middleware('gate:task.billing.series.add.access');
