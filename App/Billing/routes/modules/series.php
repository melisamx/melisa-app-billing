<?php 

Route::get('/', 'SeriesController@paging')->middleware('gate:task.billing.series.paging');
Route::get('view', 'SeriesController@view')->middleware('gate:task.billing.series.view.access');
