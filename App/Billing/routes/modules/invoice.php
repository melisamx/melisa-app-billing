<?php 

Route::get('/', 'InvoiceController@paging')->middleware('gate:task.billing.invoice.paging');
Route::get('xml', 'InvoiceController@xml')->middleware('gate:task.billing.invoice.xml');
Route::get('pdf', 'InvoiceController@pdf')->middleware('gate:task.billing.invoice.pdf');
Route::get('report/{id}/{format?}', 'InvoiceController@report')->middleware('gate:task.billing.invoice.report');
Route::get('view', 'InvoiceController@view')->middleware('gate:task.billing.invoice.view.access');
Route::get('{id}/{format?}', 'InvoiceController@report')->middleware('gate:task.billing.invoice.report');

Route::post('cancel', 'InvoiceController@cancel')->middleware('gate:task.billing.invoice.cancel');
Route::post('/', 'InvoiceController@create')->middleware('gate:task.billing.invoice.create');
