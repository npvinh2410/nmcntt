<?php

namespace Hydrogen\Media\Models;

use Hydrogen\Media\Services\UploadsManager;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends Model
{

    use SoftDeletes;
    protected $table = 'media_files';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'id', 'folder_id');
    }

    public function isShared()
    {
        return MediaShare::where('share_id', '=', $this->id)->where('share_type', '=', 'file')->count();
    }

    public function getTypeAttribute()
    {
        $type = 'document';
        if ($this->attributes['mime_type'] == 'youtube') {
            return 'video';
        }

        foreach (config('media.mime_types') as $key => $value) {
            if (in_array($this->attributes['mime_type'], $value)) {
                $type = $key;
                break;
            }
        }

        return $type;
    }

    public function getHumanSizeAttribute()
    {
        return human_file_size($this->attributes['size']);
    }

    public function getIconAttribute()
    {

        switch ($this->type) {
            case 'image':
                $icon = 'fa fa-file-image-o';
                break;
            case 'video':
                $icon = 'fa fa-file-video-o';
                break;
            case 'pdf':
                $icon = 'fa fa-file-pdf-o';
                break;
            case 'excel':
                $icon = 'fa fa-file-excel-o';
                break;
            case 'youtube':
                $icon = 'fa fa-youtube';
                break;
            default:
                $icon = 'fa fa-file-text-o';
                break;
        }
        return $icon;
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value, true) ?: [];
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

    public static $mimeTypes = [
        'zip' => 'application/zip',
        'mp3' => 'audio/mpeg',
        'bmp' => 'image/bmp',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'csv' => 'text/csv',
        'txt' => 'text/plain',
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($file) {
            // called BEFORE delete()
            // Delete any shares of this file
            /**
             * @var MediaFile $file
             */
            if ($file->isForceDeleting()) {
                MediaShare::where('share_id', '=', $file->id)->where('share_type', '=', 'file')->forceDelete();

                $uploadManager = new UploadsManager();
                $path = str_replace(config('media.upload.folder'), '', $file->url);
                $uploadManager->deleteFile($path);
            } else {
                MediaShare::where('share_id', '=', $file->id)->where('share_type', '=', 'file')->delete();
            }

            static::restoring(function ($file) {
                MediaShare::where('share_id', '=', $file->id)->where('share_type', '=', 'file')->restore();
            });
        });
    }

    public function getFocusAttribute($value)
    {
        try {
            return json_decode($value, true) ?: [];
        } catch (Exception $exception) {
            return [];
        }
    }

    public function setFocusAttribute($value)
    {
        $this->attributes['focus'] = json_encode($value);
    }

    public function __wakeup()
    {
        parent::boot();
    }
}
