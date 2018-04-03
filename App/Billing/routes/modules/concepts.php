<?php 

Route::get('/', 'ConceptsController@paging')->middleware('gate:task.billing.concepts.paging');
