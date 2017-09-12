<?php 

Route::post('/', 'ExchangeRatesController@create')->middleware('gate:task.billing.exchangeRates.create');
Route::post('delete', 'ExchangeRatesController@delete')->middleware('gate:task.billing.exchangeRates.delete');
Route::post('update', 'ExchangeRatesController@update')->middleware('gate:task.billing.exchangeRates.update');

Route::get('/', 'ExchangeRatesController@paging')->middleware('gate:task.billing.exchangeRates.paging');
Route::get('view', 'ExchangeRatesController@view')->middleware('gate:task.billing.exchangeRates.view.access');
Route::get('update', 'ExchangeRatesController@update')->middleware('gate:task.billing.exchangeRates.update.access');
Route::get('add', 'ExchangeRatesController@add')->middleware('gate:task.billing.exchangeRates.add.access');
Route::get('report/{id}/{format}', 'ExchangeRatesController@report')->middleware('gate:task.billing.exchangeRates.report');
