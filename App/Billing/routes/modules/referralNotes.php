<?php 

Route::get('/', 'ReferralNotesController@paging')->middleware('gate:task.billing.referralNotes.paging');
Route::get('report/{id}/{format?}', 'ReferralNotesController@report')->middleware('gate:task.billing.referralNotes.report');
Route::get('view', 'ReferralNotesController@view')->middleware('gate:task.billing.referralNotes.view.access');
