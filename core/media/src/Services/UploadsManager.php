<?php

namespace Hydrogen\Media\Services;

use Hydrogen\Media\Models\MediaFile;
use Carbon\Carbon;
use Storage;
use File;

class UploadsManager
{
    protected $disk;
    public function __construct()
    {
        config()->set('filesystems.disks.local.root', config('media.upload.path'));

        $this->disk = Storage::disk(config('filesystems.default'));
    }
    protected function cleanFolder($folder)
    {
        return DIRECTORY_SEPARATOR . trim(str_replace('..', '', $folder), DIRECTORY_SEPARATOR);
    }

    public function fileDetails($path)
    {
        return [
            'filename' => basename($path),
            'url' => '/' . $this->uploadPath($path),
            'mime_type' => $this->fileMimeType($path),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    public function uploadPath($path)
    {
        return rtrim(ltrim(str_replace('\\', '', str_replace(public_path(), '', config('media.upload.path'))), '/'), '/') . '/' . ltrim($path, '/');
    }

    public function fileMimeType($path)
    {
        return array_get(MediaFile::$mimeTypes, strtolower(File::extension($path)));
    }

    public function fileSize($path)
    {
        return $this->disk->size($path);
    }


    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            $this->disk->lastModified($path)
        );
    }

    public function createDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        if ($this->disk->exists($folder)) {
            return trans('media::media.folder_exists', ['folder' => $folder]);
        }

        return $this->disk->makeDirectory($folder);
    }

    public function deleteDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        $filesFolders = array_merge(
            $this->disk->directories($folder),
            $this->disk->files($folder)
        );
        if (!empty($filesFolders)) {
            return trans('media::media.directory_must_empty');
        }

        return $this->disk->deleteDirectory($folder);
    }

    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);

        if (!$this->disk->exists($path)) {
            info(trans('media::media.file_not_exists'));
        }

        if (is_image($this->fileMimeType($path))) {
            $filename = pathinfo($path, PATHINFO_FILENAME);
            $thumb = str_replace($filename, $filename . '-' . config('media.sizes.thumb'), $path);
            $featured = str_replace($filename, $filename . '-' . config('media.sizes.featured'), $path);

            return $this->disk->delete([$path, $thumb, $featured]);
        } else {
            return $this->disk->delete([$path]);
        }
    }

    public function saveFile($path, $content)
    {
        $path = $this->cleanFolder($path);

        return $this->disk->put($path, $content);
    }
}
