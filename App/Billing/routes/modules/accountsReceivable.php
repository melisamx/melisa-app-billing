<?php 

Route::post('/', 'AccountsReceivableController@create')->middleware('gate:task.billing.accountsReceivable.create');
Route::post('charged', 'AccountsReceivableController@payoff')->middleware('gate:task.billing.accountsReceivable.payoff');
Route::post('autoregister', 'AccountsReceivableController@autoregister')->middleware('gate:task.billing.accountsReceivable.autoregister');

Route::get('/', 'AccountsReceivableController@paging')->middleware('gate:task.billing.accountsReceivable.paging');
Route::get('view', 'AccountsReceivableController@view')->middleware('gate:task.billing.accountsReceivable.view.access');
Route::get('add', 'AccountsReceivableController@add')->middleware('gate:task.billing.accountsReceivable.add.access');
Route::get('report/{id}/{format?}', 'AccountsReceivableController@report')->middleware('gate:task.billing.accountsReceivable.report');
