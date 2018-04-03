<?php 

Route::get('/', 'UseCfdiController@paging')->middleware('gate:task.billing.useCfdi.paging');
