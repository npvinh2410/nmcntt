<?php

Route::group(['namespace' => 'Hydrogen\Setting\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard'], function () {

        Route::group(['middleware' => ['auth']], function() {

            Route::any('settings', 'SettingController@index')->name('settings.index');

            Route::post('settings', 'SettingController@update')->name('settings.update');

        });

    });

});