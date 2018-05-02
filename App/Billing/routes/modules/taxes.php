<?php 

Route::get('/', 'TaxesController@paging')->middleware('gate:task.billing.conceptKeys.paging');
