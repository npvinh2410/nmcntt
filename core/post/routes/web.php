<?php

Route::group(['namespace' => 'Hydrogen\Post\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::middleware(['auth'])->group(function () {


            // CATEGORY

            // list
            Route::get('/categories', 'CategoryController@index')->name('categories.index');

//             create
            Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
            Route::post('/categories', 'CategoryController@store')->name('categories.store');

//             translate
            Route::get('/categories/{id}/trans/{lang_code}', 'CategoryController@trans')->name('categories.trans');
            Route::post('/categories/{id}', 'CategoryController@storeTrans')->name('categories.storeTrans');

//             show
            Route::get('/categories/{id}/{lang_code}', 'CategoryController@show')->name('categories.show');

//             edit
            Route::get('/categories/{id}/{lang_code}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::put('/categories/{id}/{lang_code}', 'CategoryController@update')->name('categories.update');

//             delete
            Route::delete('/categories/{id}', 'CategoryController@destroy')->name('categories.destroy');

            // POST
//            list
            Route::get('/posts', 'PostController@index')->name('posts.index');

//             create
            Route::get('/posts/create', 'PostController@create')->name('posts.create');
            Route::post('/posts', 'PostController@store')->name('posts.store');

//             translate
            Route::get('/posts/{id}/trans/{lang_code}', 'PostController@trans')->name('posts.trans');
            Route::post('/posts/{id}', 'PostController@storeTrans')->name('posts.storeTrans');

//             show
            Route::get('/posts/{id}/{lang_code}', 'PostController@show')->name('posts.show');

//             edit
            Route::get('/posts/{id}/{lang_code}/edit', 'PostController@edit')->name('posts.edit');
            Route::put('/posts/{id}/{lang_code}', 'PostController@update')->name('posts.update');

//             delete
            Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');



        });
    });
});