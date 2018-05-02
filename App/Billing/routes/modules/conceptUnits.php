<?php 

Route::get('/', 'ConceptUnitsController@paging')->middleware('gate:task.billing.conceptUnits.paging');
