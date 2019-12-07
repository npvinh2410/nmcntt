<?php

Route::group(['namespace' => 'Hydrogen\Widget\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::middleware(['auth'])->group(function () {

            // list
            Route::get('/widgets', 'WidgetController@index')->name('widgets.index');

            // create
            Route::get('/widgets/create', 'WidgetController@create')->name('widgets.create');
            Route::post('/widgets', 'WidgetController@store')->name('widgets.store');

            // translate
            Route::get('/widgets/{id}/trans/{lang_code}', 'WidgetController@trans')->name('widgets.trans');
            Route::post('/widgets/{id}', 'WidgetController@storeTrans')->name('widgets.storeTrans');

            // show
            Route::get('/widgets/{id}/{lang_code}', 'WidgetController@show')->name('widgets.show');

            // edit
            Route::get('/widgets/{id}/{lang_code}/edit', 'WidgetController@edit')->name('widgets.edit');
            Route::put('/widgets/{id}/{lang_code}', 'WidgetController@update')->name('widgets.update');

            // delete
            Route::delete('/widgets/{id}', 'WidgetController@destroy')->name('widgets.destroy');

        });
    });
});