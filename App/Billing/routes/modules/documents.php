<?php 

Route::get('/', 'DocumentsController@paging')->middleware('gate:task.billing.documents.paging');
Route::get('xml', 'DocumentsController@xml')->middleware('gate:task.billing.documents.xml');
Route::get('pdf', 'DocumentsController@pdf')->middleware('gate:task.billing.documents.pdf');
Route::get('report/{id}/{format?}', 'DocumentsController@report')->middleware('gate:task.billing.documents.report');
Route::get('view', 'DocumentsController@view')->middleware('gate:task.billing.documents.view.access');
Route::get('{id}/pdf', 'DocumentsController@pdf')->middleware('gate:task.billing.documents.report');
Route::get('{id}/xml', 'DocumentsController@xml')->middleware('gate:task.billing.documents.report');
Route::get('{id}', 'DocumentsController@report')->middleware('gate:task.billing.documents.report');

Route::post('cancel', 'DocumentsController@cancel')->middleware('gate:task.billing.documents.cancel');
Route::delete('{id}', 'DocumentsController@delete')->middleware('gate:task.billing.documents.delete');
Route::post('/', 'DocumentsController@create')->middleware('gate:task.billing.documents.create');
