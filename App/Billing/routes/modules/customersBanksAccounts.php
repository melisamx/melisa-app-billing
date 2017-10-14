<?php 

Route::post('/', 'CustomersBanksAccountsController@create')->middleware('gate:task.billing.customersBanksAccounts.create');
Route::post('delete', 'CustomersBanksAccountsController@delete')->middleware('gate:task.billing.customersBanksAccounts.delete');
Route::post('update', 'CustomersBanksAccountsController@update')->middleware('gate:task.billing.customersBanksAccounts.update');
Route::post('activate', 'CustomersBanksAccountsController@activate')->middleware('gate:task.billing.customersBanksAccounts.activate');
Route::post('deactivate', 'CustomersBanksAccountsController@deactivate')->middleware('gate:task.billing.customersBanksAccounts.deactivate');

Route::get('/', 'CustomersBanksAccountsController@paging')->middleware('gate:task.billing.customersBanksAccounts.paging');
Route::get('view', 'CustomersBanksAccountsController@view')->middleware('gate:task.billing.customersBanksAccounts.view.access');
Route::get('update', 'CustomersBanksAccountsController@update')->middleware('gate:task.billing.customersBanksAccounts.update.access');
Route::get('add', 'CustomersBanksAccountsController@add')->middleware('gate:task.billing.customersBanksAccounts.add.access');
Route::get('report/{id}/{format}', 'CustomersBanksAccountsController@report')->middleware('gate:task.billing.customersBanksAccounts.report');
