<?php 

Route::get('/', 'RepositoriesController@paging')
    ->middleware('gate:task.api.insurance.repositories.paging');