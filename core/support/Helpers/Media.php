<?php
use Carbon\Carbon;

if (!function_exists('getUrl'))
{
    function getUrl()
    {
        return [
            'base_url' => asset(''),

            'base' => url(config('media.route.prefix')),

            'get_media' => route('media.list'),

            'create_folder' => route('media.folders.create'),

            'get_quota' => route('media.quota'),

            'popup' => route('media.popup'),

            'download' => route('media.download'),

            'upload_file' => route('media.files.upload'),
            'add_external_service' => route('media.files.add_external_service'),

            'get_breadcrumbs' => route('media.breadcrumbs'),

            'global_actions' => route('media.global_actions'),

            'get_users' => route('media.users.list'),

            'get_shared_users' => route('media.shares.list_shared_users'),

            'media_upload_from_editor' => route('media.files.upload.from.editor'),
        ];
    }
}

if (!function_exists('getPermission')) {
    function getPermission()
    {
        $permissions = [];

        $list = ['media-files-create', 'media-files-edit', 'media-files-destroy', 'media-files-trash', 'media-folders-create', 'media-folders-edit', 'media-folders-destroy', 'media-folders-trash'];

        foreach ($list as $permission)
        {
            if(hydrogen_authorize($permission, true))
            {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}

if (!function_exists('is_image')) {
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if (!function_exists('get_image_url')) {
    function get_image_url($url, $size = null, $relative_path = false, $default = null)
    {
        if (empty($url)) {
            return $default;
        }

        if (array_key_exists($size, config('media.sizes'))) {
            $url = str_replace(File::name($url) . '.' . File::extension($url), File::name($url) . '-' . config('media.sizes.' . $size) . '.' . File::extension($url), $url);
        }

        if ($relative_path) {
            return $url;
        }
        return url($url);
    }
}

if (!function_exists('get_object_image')) {
    function get_object_image($image, $size = null, $relative_path = false)
    {
        if (!empty($image)) {
            if (empty($size) || $image == '__value__') {
                if ($relative_path) {
                    return $image;
                }
                return url($image);
            }
            return get_image_url($image, $size, $relative_path);
        } else {
            return get_image_url(config('media.default-img'), $size, $relative_path);
        }
    }
}

if (!function_exists('rv_media_handle_upload')) {
    function rv_media_handle_upload($fileUpload, $folder_id = 0) {
        return HMedia::handleUpload($fileUpload, $folder_id);
    }
}

if (!function_exists('rv_get_image_list')) {
    function rv_get_image_list(array $imagesList, array $sizes)
    {
        $result = [];
        foreach ($sizes as $size) {
            $images = [];

            foreach ($imagesList as $url) {
                $images[] = get_image_url($url, $size);
            }

            $result[$size] = $images;
        }

        return $result;
    }
}

if (!function_exists('format_time')) {
    function format_time(DateTime $timestamp, $format = 'j M Y H:i')
    {
        $first = Carbon::create(0000, 0, 0, 00, 00, 00);
        if ($timestamp->lte($first)) {
            return '';
        }

        return $timestamp->format($format);
    }
}

if (!function_exists('date_from_database')) {
    function date_from_database($time, $format = 'Y-m-d')
    {
        return format_time(Carbon::parse($time), $format);
    }
}

if (!function_exists('human_file_size')) {
    function human_file_size($bytes, $precision = 2)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return number_format($bytes, $precision, ',', '.') . ' ' . $units[$pow];
    }
}

if (!function_exists('string_limit_words')) {
    function string_limit_words($string, $limit)
    {
        $ext = null;
        if (strlen($string) > $limit) {
            $ext = '...';
        }
        $string = substr($string, 0, $limit);
        return $string . $ext;
    }
}

if (!function_exists('get_file_data')) {
    function get_file_data($file, $convert_to_array = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        return [];
    }
}

if (!function_exists('json_encode_prettify')) {
    function json_encode_prettify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('save_file_data')) {
    function save_file_data($path, $data, $json = true)
    {
        try {
            if ($json) {
                $data = json_encode_prettify($data);
            }
            File::put($path, $data);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

if (!function_exists('scan_folder')) {
    function scan_folder($path, $ignore_files = [])
    {
        try {
            if (is_dir($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                natsort($data);
                return $data;
            }
            return [];
        } catch (Exception $ex) {
            return [];
        }
    }
}