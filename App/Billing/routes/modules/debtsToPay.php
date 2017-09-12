<?php 

Route::post('/', 'DebtsToPayController@create')->middleware('gate:task.billing.debtsToPay.create');
Route::post('payoff', 'DebtsToPayController@payoff')->middleware('gate:task.billing.debtsToPay.payoff');

Route::get('/', 'DebtsToPayController@paging')->middleware('gate:task.billing.debtsToPay.paging');
Route::get('view', 'DebtsToPayController@view')->middleware('gate:task.billing.debtsToPay.view.access');
Route::get('add', 'DebtsToPayController@add')->middleware('gate:task.billing.debtsToPay.add.access');
Route::get('report/{id}/{format?}', 'DebtsToPayController@report')->middleware('gate:task.billing.debtsToPay.report');