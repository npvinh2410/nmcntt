<?php

Route::group(['namespace' => 'Hydrogen\Product\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::middleware(['auth'])->group(function () {

            Route::resource('taxes', 'TaxController');

            // Attribute

            // list
            Route::get('/attributes', 'AttributeController@index')->name('attributes.index');

            //create
            Route::get('/attributes/create', 'AttributeController@create')->name('attributes.create');
            Route::post('/attributes', 'AttributeController@store')->name('attributes.store');

            //translate
            Route::get('/attributes/{id}/trans/{lang_code}', 'AttributeController@trans')->name('attributes.trans');
            Route::post('/attributes/{id}', 'AttributeController@storeTrans')->name('attributes.storeTrans');

            //show
            Route::get('/attributes/{id}/{lang_code}', 'AttributeController@show')->name('attributes.show');

            //edit
            Route::get('/attributes/{id}/{lang_code}/edit', 'AttributeController@edit')->name('attributes.edit');
            Route::put('/attributes/{id}/{lang_code}', 'AttributeController@update')->name('attributes.update');

            //delete
            Route::delete('/attributes/{id}', 'AttributeController@destroy')->name('attributes.destroy');


            // Catalog

            // list
            Route::get('/catalogs', 'CatalogController@index')->name('catalogs.index');

            //create
            Route::get('/catalogs/create', 'CatalogController@create')->name('catalogs.create');
            Route::post('/catalogs', 'CatalogController@store')->name('catalogs.store');

            //translate
            Route::get('/catalogs/{id}/trans/{lang_code}', 'CatalogController@trans')->name('catalogs.trans');
            Route::post('/catalogs/{id}', 'CatalogController@storeTrans')->name('catalogs.storeTrans');

            //show
            Route::get('/catalogs/{id}/{lang_code}', 'CatalogController@show')->name('catalogs.show');

            //edit
            Route::get('/catalogs/{id}/{lang_code}/edit', 'CatalogController@edit')->name('catalogs.edit');
            Route::put('/catalogs/{id}/{lang_code}', 'CatalogController@update')->name('catalogs.update');

            //delete
            Route::delete('/catalogs/{id}', 'CatalogController@destroy')->name('catalogs.destroy');

            // Catalog

            // list
            Route::get('/tags', 'TagController@index')->name('tags.index');

            //create
            Route::get('/tags/create', 'TagController@create')->name('tags.create');
            Route::post('/tags', 'TagController@store')->name('tags.store');

            //translate
            Route::get('/tags/{id}/trans/{lang_code}', 'TagController@trans')->name('tags.trans');
            Route::post('/tags/{id}', 'TagController@storeTrans')->name('tags.storeTrans');

            //show
            Route::get('/tags/{id}/{lang_code}', 'TagController@show')->name('tags.show');

            //edit
            Route::get('/tags/{id}/{lang_code}/edit', 'TagController@edit')->name('tags.edit');
            Route::put('/tags/{id}/{lang_code}', 'TagController@update')->name('tags.update');

            //delete
            Route::delete('/tags/{id}', 'TagController@destroy')->name('tags.destroy');



            // Product

            // list
            Route::get('/products', 'ProductController@index')->name('products.index');

            //create
            Route::get('/products/create', 'ProductController@create')->name('products.create');
            Route::post('/products', 'ProductController@store')->name('products.store');

            //translate
            Route::get('/products/{id}/trans/{lang_code}', 'ProductController@trans')->name('products.trans');
            Route::post('/products/{id}', 'ProductController@storeTrans')->name('products.storeTrans');

            //show
            Route::get('/products/{id}/{lang_code}', 'ProductController@show')->name('products.show');

            //edit
            Route::get('/products/{id}/{lang_code}/edit', 'ProductController@edit')->name('products.edit');
            Route::put('/products/{id}/{lang_code}', 'ProductController@update')->name('products.update');

            //delete
            Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');

        });
    });
});