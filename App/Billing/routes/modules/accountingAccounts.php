<?php 

Route::post('/', 'AccountingAccountsController@create')->middleware('gate:task.billing.accountingAccounts.create');
Route::post('delete', 'AccountingAccountsController@delete')->middleware('gate:task.billing.accountingAccounts.delete');
Route::post('update', 'AccountingAccountsController@update')->middleware('gate:task.billing.accountingAccounts.update');

Route::get('/', 'AccountingAccountsController@paging')->middleware('gate:task.billing.accountingAccounts.paging');
Route::get('update', 'AccountingAccountsController@update')->middleware('gate:task.billing.accountingAccounts.update.access');
Route::get('view', 'AccountingAccountsController@view')->middleware('gate:task.billing.accountingAccounts.view.access');
Route::get('add', 'AccountingAccountsController@add')->middleware('gate:task.billing.accountingAccounts.add.access');
Route::get('report/{id}/{format?}', 'AccountingAccountsController@report')->middleware('gate:task.billing.accountingAccounts.report');
