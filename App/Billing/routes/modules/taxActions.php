<?php 

Route::get('/', 'TaxActionsController@paging')->middleware('gate:task.billing.taxActions.paging');
