<?php


Route::group(['namespace' => 'Hydrogen\Seo\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard'], function () {

        Route::group(['middleware' => ['auth']], function() {

            Route::resource('/seoUpdate', 'SeoUpdateController');

        });

    });

});