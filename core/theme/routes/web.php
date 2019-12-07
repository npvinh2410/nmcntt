<?php


Route::group(['namespace' => 'Hydrogen\Theme\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function() {

        Route::get('/', 'FrontendController@home')->name('root');

        Route::get('{slug}', 'FrontendController@show_view')->name('view');

    });

});