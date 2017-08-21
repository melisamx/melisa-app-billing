<?php 

Route::post('/', 'AccountsController@create')->middleware('gate:task.billing.accounts.create');

Route::get('/', 'AccountsController@paging')->middleware('gate:task.billing.accounts.paging');
Route::get('view', 'AccountsController@view')->middleware('gate:task.billing.accounts.view.access');
Route::get('add', 'AccountsController@add')->middleware('gate:task.billing.accounts.add.access');
Route::get('report/{id}/{format?}', 'AccountsController@report')->middleware('gate:task.billing.accounts.report');
