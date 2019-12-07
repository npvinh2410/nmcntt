<?php

Route::group(['namespace' => 'Hydrogen\Slider\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard'], function () {

        Route::group(['middleware' => ['auth']], function() {

            Route::post('/ajax/reorder/slide','SliderController@reOrderSlide')->name('reorder-slide');

            Route::resource('sliders', 'SliderController');

            Route::get('sliders/{id}/slides', 'SliderController@slideList')->name('sliders.slides');
            Route::get('sliders/{id}/slides/create', 'SlideController@create')->name('slides.create');
            Route::post('slides', 'SlideController@store')->name('slides.store');
            Route::get('slides/{id}/edit', 'SlideController@edit')->name('slides.edit');
            Route::put('slides/{id}', 'SlideController@update')->name('slides.update');
            Route::delete('slides/{id}', 'SlideController@destroy')->name('slides.destroy');


        });

    });

});