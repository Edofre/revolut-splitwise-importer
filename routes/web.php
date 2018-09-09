<?php

// TODO, REFACTOR
/*
|--------------------------------------------------------------------------
| Import routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'ImportController@index')
    ->name('home');

Route::group(['as' => 'import.'], function () {
    // Process upload
    Route::post('/import', 'ImportController@upload')
        ->name('upload');
    // Show Import model
    Route::get('/import/{import}', 'ImportController@show')
        ->name('show');
    // Process import into import rows
    Route::get('/import/{import}/process', 'ImportController@process')
        ->name('process');

    // Data import rows
    Route::any('/import/{import}/rows/data', 'ImportRowController@data')
        ->name('rows.data');
    // Delete rows
    Route::delete('/import/rows/{importRow}/destroy', 'ImportRowController@destroy')
        ->name('rows.destroy');
    Route::delete('/import/rows/destroy', 'ImportRowController@destroyMultiple')
        ->name('rows.destroy.multiple');

    // Rows overview
    Route::get('/import/{import}/rows/overview', 'ImportRowController@overview')
        ->name('rows.overview');
});
