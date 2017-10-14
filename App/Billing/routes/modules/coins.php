<?php 

Route::get('/', 'CoinsController@paging')->middleware('gate:task.billing.coins.paging');
