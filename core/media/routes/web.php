<?php

Route::group(['namespace' => 'Hydrogen\Media\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => 'dashboard/media', 'middleware' => ['auth'] ], function () {

        Route::get('/', [
            'as' => 'media.index',
            'uses' => 'MediaController@getMedia',
        ]);

        Route::get('/popup', [
            'as' => 'media.popup',
            'uses' => 'MediaController@getPopup',
        ]);

        Route::get('/list', [
            'as' => 'media.list',
            'uses' => 'MediaController@getList',
        ]);

        Route::get('/quota', [
            'as' => 'media.quota',
            'uses' => 'MediaController@getQuota',
        ]);

        Route::get('/breadcrumbs', [
            'as' => 'media.breadcrumbs',
            'uses' => 'MediaController@getBreadcrumbs',
        ]);

        Route::post('/global-actions', [
            'as' => 'media.global_actions',
            'uses' => 'MediaController@postGlobalActions',
        ]);

        Route::get('/download', [
            'as' => 'media.download',
            'uses' => 'MediaController@download',
        ]);

        Route::group(['prefix' => 'files'], function () {

            Route::post('/upload', [
                'as' => 'media.files.upload',
                'uses' => 'MediaFileController@postUpload',
            ]);

            Route::post('/upload-from-editor', [
                'as' => 'media.files.upload.from.editor',
                'uses' => 'MediaFileController@postUploadFromEditor',
            ]);

            Route::post('/add-external-service', [
                'as' => 'media.files.add_external_service',
                'uses' => 'MediaFileController@postAddExternalService',
            ]);

        });

        Route::group(['prefix' => 'folders'], function () {

            Route::post('/create', [
                'as' => 'media.folders.create',
                'uses' => 'MediaFolderController@postCreate',
            ]);
        });

        Route::group(['prefix' => 'users'], function () {

            Route::get('/get-list', [
                'as' => 'media.users.list',
                'uses' => 'UserController@getList',
            ]);
        });

        Route::group(['prefix' => 'shares'], function () {

            Route::get('/get-shared-users', [
                'as' => 'media.shares.list_shared_users',
                'uses' => 'MediaShareController@getSharedUsers',
            ]);
        });

    });
    
});