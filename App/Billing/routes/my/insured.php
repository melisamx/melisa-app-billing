<?php 

Route::post('/', 'InsuredController@create')->middleware('gate:task.insurance.my.insured.create');
Route::post('delete', 'InsuredController@delete')->middleware('gate:task.insurance.my.insured.delete');
Route::post('update', 'InsuredController@update')->middleware('gate:task.insurance.my.insured.update');

Route::get('/', 'InsuredController@paging')->middleware('gate:task.insurance.my.insured.paging');
Route::get('view', 'InsuredController@view')->middleware('gate:task.insurance.my.insured.view.access');
Route::get('update', 'InsuredController@update')->middleware('gate:task.insurance.my.insured.update.access');
Route::get('add', 'InsuredController@add')->middleware('gate:task.insurance.my.insured.add.access');
Route::get('report/{id}/{format}', 'InsuredController@report')->middleware('gate:task.insurance.my.insured.report');
