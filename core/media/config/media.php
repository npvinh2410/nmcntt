<?php

return [
    'sizes' => [
        'thumb' => '250x230',
        'featured' => '560x380',
        'medium' => '540x360',
        'sidebar' => '65x60',
    ],
    'upload' => [
        'folder' => 'uploads',
        'path' => public_path('uploads'),
        // User will can not create folder with these name
        'reserved_names' => [
            // 'avatars',
        ],
    ],
    'route' => [
        'prefix' => env('ADMIN_DIR', 'admin') . '/media',
        'middleware' => ['web', 'auth'],
        'options' => [
            'permission' => 'media.index',
        ],
    ],

    'cache' => [
        'enable' => env('RV_MEDIA_ENABLE_CACHE', false), // true or false
        'cache_time' => env('RV_MEDIA_CACHE_TIME', 10),
        'stored_keys' => storage_path('media_cache_keys.json'), // Cache config
    ],
    'allow_external_services' => env('RV_MEDIA_ALLOW_EXTERNAL_SERVICES', false),
    'external_services' => [
        'youtube',
        'vimeo',
        'dailymotion',
        'instagram',
        'vine',
    ],
    'allowed_mime_types' => env('RV_MEDIA_ALLOWED_MIME_TYPES', 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,docs,xls,xlsx,ppt,pptx,pdf,mp4'),
    'mime_types' => [
        'image' => [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
        ],
        'video' => [
            'video/mp4',
        ],
        'pdf' => [
            'application/pdf',
        ],
        'excel' => [
            'application/excel',
            'application/x-excel',
            'application/x-msexcel',
        ],
        'youtube' => [
            'youtube',
        ],
    ],
    'max_file_size_upload' => env('RV_MEDIA_MAX_FILE_SIZE_UPLOAD', 4 * 1024), // Maximum size to upload
    'default-img' => env('RV_MEDIA_DEFAULT_IMAGE', '/vendor/core/images/default-image.png'), // Default image
    'user_attributes' => 'users.id, users.name',
    'layouts' => [
        'master' => 'bases::layouts.master',
        'main' => 'content',
        'header' => 'head',
        'footer' => 'javascript',
    ],
];
