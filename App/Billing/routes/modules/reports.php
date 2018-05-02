<?php 

Route::group([
    'prefix'=>'billsPaid'
], function() {
    Route::get('view', 'ReportsController@billsPaid')->middleware('gate:task.billing.reports.billsPaid.view.access');
    Route::get('/', 'ReportsController@billsPaid')->middleware('gate:task.billing.reports.billPaid.paging');
});
