<?php 

Route::get('/', 'TypesFactorController@paging')->middleware('gate:task.billing.typesFactor.paging');
