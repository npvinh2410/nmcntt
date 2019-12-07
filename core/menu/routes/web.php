<?php

Route::group(['namespace' => 'Hydrogen\Menu\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard'], function () {

        Route::group(['middleware' => ['auth']], function() {

            Route::resource('menus', 'MenuController');

        });

    });

});