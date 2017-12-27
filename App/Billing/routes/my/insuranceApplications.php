<?php 

Route::post('/', 'InsuranceApplicationsController@create')->middleware('gate:task.insurance.my.insuranceApplications.create');
Route::post('delete', 'InsuranceApplicationsController@delete')->middleware('gate:task.insurance.my.insuranceApplications.delete');
Route::post('update', 'InsuranceApplicationsController@update')->middleware('gate:task.insurance.my.insuranceApplications.update');

Route::get('/', 'InsuranceApplicationsController@paging')->middleware('gate:task.insurance.my.insuranceApplications.paging');
Route::get('view', 'InsuranceApplicationsController@view')->middleware('gate:task.insurance.my.insuranceApplications.view.access');
Route::get('add', 'InsuranceApplicationsController@add')->middleware('gate:task.insurance.my.insuranceApplications.add.access');
Route::get('update', 'InsuranceApplicationsController@update')->middleware('gate:task.insurance.my.insuranceApplications.update.access');
Route::get('report/{id}/{format}', 'InsuranceApplicationsController@report')->middleware('gate:task.insurance.my.insuranceApplications.report');
