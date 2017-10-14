<?php 

Route::post('/', 'CustomerGroupsIdentitiesController@create')
    ->middleware('gate:task.insurance.customerGroupsIdentities.create');
Route::post('delete', 'CustomerGroupsIdentitiesController@delete')
    ->middleware('gate:task.insurance.customerGroupsIdentities.delete');

Route::get('/', 'CustomerGroupsIdentitiesController@paging')
    ->middleware('gate:task.insurance.customerGroupsIdentities.paging');
Route::get('view', 'CustomerGroupsIdentitiesController@view')
    ->middleware('gate:task.insurance.customerGroupsIdentities.view.access');
Route::get('add', 'CustomerGroupsIdentitiesController@add')
    ->middleware('gate:task.insurance.customerGroupsIdentities.add.access');
