<?php


Route::group(['namespace' => 'Hydrogen\Base\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard'], function (){

        Route::get('login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@authenticate')->name('authenticate');
        Route::post('notification', 'AjaxController@notification_status');

        Route::middleware(['auth'])->group(function (){

            //ajax
            Route::post('/attributesValue', 'AjaxController@attributesValue');
            Route::post('/features', 'AjaxController@features');
            Route::post('/options', 'AjaxController@options');
            Route::post('/contacts/seen', 'AjaxController@contact');
            //ajax



            Route::any('/logout', 'AuthController@logout')->name('logout');
            Route::get('/', 'DashboardController')->name('dashboard');


            Route::get('create_bundle', ['as' => 'permissions.create_bundle', 'uses' => 'PermissionController@create_bundle']);
            Route::post('create_bundle', ['as' => 'permissions.store_bundle', 'uses' => 'PermissionController@store_bundle']);
            Route::resource('permissions', 'PermissionController');
            Route::resource('roles', 'RoleController');

            Route::get('users', 'UserController@index')->name('users.index');

            // Client
            Route::get('clients/create', 'UserController@create_client')->name('clients.create');
            Route::post('clients/create', 'UserController@store_client')->name('clients.store');

            Route::get('clients/{id}/show', 'UserController@show_client')->name('clients.show');

            Route::get('clients/{id}/edit', 'UserController@edit_client')->name('clients.edit');
            Route::put('clients/{id}/edit', 'UserController@update_client')->name('clients.update');

            Route::delete('clients/{id}', 'UserController@destroy_client')->name('clients.destroy');


            // Admin
            Route::get('admins/create', 'UserController@create_admin')->name('admins.create');
            Route::post('admins/create', 'UserController@store_admin')->name('admins.store');

            Route::get('admins/{id}/show', 'UserController@show_admin')->name('admins.show');

            Route::get('admins/{id}/edit', 'UserController@edit_admin')->name('admins.edit');
            Route::put('admins/{id}/edit', 'UserController@update_admin')->name('admins.update');

            Route::delete('admins/{id}', 'UserController@destroy_admin')->name('admins.destroy');


            // Contacts

            Route::get('contacts', 'ContactController@index')->name('contacts.index');
            Route::get('contacts/{id}/show', 'ContactController@show')->name('contacts.show');
            Route::delete('contacts/{id}', 'ContactController@destroy')->name('contacts.destroy');

        });

    });

    Route::post('contacts', 'ContactController@create')->name('contacts.create');
    Route::post('getProductInfo', 'AjaxController@getProductInfo');
    Route::post('ratings', 'AjaxController@ratings');

});