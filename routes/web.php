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