<?php

Route::group(['namespace' => 'Hydrogen\Page\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::middleware(['auth'])->group(function () {

            // list
            Route::get('/pages', 'PageController@index')->name('pages.index');

            // create
            Route::get('/pages/create', 'PageController@create')->name('pages.create');
            Route::post('/pages', 'PageController@store')->name('pages.store');

            // translate
            Route::get('/pages/{id}/trans/{lang_code}', 'PageController@trans')->name('pages.trans');
            Route::post('/pages/{id}', 'PageController@storeTrans')->name('pages.storeTrans');

            // show
            Route::get('/pages/{id}/{lang_code}', 'PageController@show')->name('pages.show');

            // edit
            Route::get('/pages/{id}/{lang_code}/edit', 'PageController@edit')->name('pages.edit');
            Route::put('/pages/{id}/{lang_code}', 'PageController@update')->name('pages.update');

            // delete
            Route::delete('/pages/{id}', 'PageController@destroy')->name('pages.destroy');

        });
    });
});