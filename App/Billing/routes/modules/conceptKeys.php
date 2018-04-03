<?php 

Route::get('/', 'ConceptKeysController@paging')->middleware('gate:task.billing.conceptKeys.paging');
