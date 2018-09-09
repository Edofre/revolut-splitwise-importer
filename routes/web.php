<?php

/*
|--------------------------------------------------------------------------
| Import routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'ImportController@index')
    ->name('home');
Route::post('/import', 'ImportController@upload')
    ->name('import.upload');

// Show results
Route::get('/import/{import}', 'ImportController@show')
    ->name('import.show');
Route::get('/import/{import}/process', 'ImportController@process')
    ->name('import.process');

// Datatable route for showing import rows
Route::any('/import/{import}/rows/data/', 'ImportController@importRowData')
    ->name('import.rows.data');

Route::delete('/import/rows/{importRow}/destroy', 'ImportController@importRowDestroy')
    ->name('import.rows.destroy');