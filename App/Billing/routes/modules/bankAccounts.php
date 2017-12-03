<?php 

Route::post('/', 'BankAccountsController@create')->middleware('gate:task.billing.bankAccounts.create');
Route::post('delete', 'BankAccountsController@delete')->middleware('gate:task.billing.bankAccounts.delete');
Route::post('update', 'BankAccountsController@update')->middleware('gate:task.billing.bankAccounts.update');
Route::post('activate', 'BankAccountsController@activate')->middleware('gate:task.billing.bankAccounts.activate');
Route::post('deactivate', 'BankAccountsController@deactivate')->middleware('gate:task.billing.bankAccounts.deactivate');
Route::get('create', 'BankAccountsController@create')->middleware('gate:task.billing.bankAccounts.create');
Route::post('update', 'BankAccountsController@update')->middleware('gate:task.billing.bankAccounts.update');

Route::get('/', 'BankAccountsController@paging')->middleware('gate:task.billing.bankAccounts.paging');
Route::get('view', 'BankAccountsController@view')->middleware('gate:task.billing.bankAccounts.view.access');
Route::get('update', 'BankAccountsController@update')->middleware('gate:task.billing.bankAccounts.update.access');
Route::get('add', 'BankAccountsController@add')->middleware('gate:task.billing.bankAccounts.add.access');
Route::get('report/{id}/{format?}', 'BankAccountsController@report')->middleware('gate:task.billing.bankAccounts.report');
