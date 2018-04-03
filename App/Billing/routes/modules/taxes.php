<?php 

Route::get('/', 'TaxesController@paging')->middleware('gate:task.billing.taxes.paging');
