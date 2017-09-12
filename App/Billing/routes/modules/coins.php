<?php 

Route::get('/', 'CoinsController@paging')->middleware('gate:task.insurance.coins.paging');
