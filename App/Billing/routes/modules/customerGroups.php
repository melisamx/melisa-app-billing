<?php 

Route::post('/', 'CustomerGroupsController@create')
    ->middleware('gate:task.insurance.customerGroups.create');
Route::post('delete', 'CustomerGroupsController@delete')
    ->middleware('gate:task.insurance.customerGroups.delete');
Route::post('update', 'CustomerGroupsController@update')
    ->middleware('gate:task.insurance.customerGroups.update');
Route::post('activate', 'CustomerGroupsController@activate')
    ->middleware('gate:task.insurance.customerGroups.activate');
Route::post('deactivate', 'CustomerGroupsController@deactivate')
    ->middleware('gate:task.insurance.customerGroups.deactivate');

Route::get('/', 'CustomerGroupsController@paging')
    ->middleware('gate:task.insurance.customerGroups.paging');
Route::get('view', 'CustomerGroupsController@view')
    ->middleware('gate:task.insurance.customerGroups.view.access');
Route::get('update', 'CustomerGroupsController@update')
    ->middleware('gate:task.insurance.customerGroups.update.access');
Route::get('add', 'CustomerGroupsController@add')
    ->middleware('gate:task.insurance.customerGroups.add.access');
Route::get('report/{id}/{format}', 'CustomerGroupsController@report')
    ->middleware('gate:task.insurance.customerGroups.report');
