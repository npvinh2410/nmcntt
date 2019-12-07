<?php

namespace Hydrogen\Media;

use Hydrogen\Media\Repositories\Contracts\MediaFileInterface;
use Hydrogen\Media\Repositories\Contracts\MediaFolderInterface;
use Hydrogen\Media\Services\UploadsManager;
use Hydrogen\Media\Services\ThumbnailService;
use Exception;
use File;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\UploadedFile;

class HMedia
{

    protected $uploadManager;
    protected $fileRepository;
    protected $folderRepository;
    protected $thumbnailService;

    public function __construct(
        MediaFileInterface $fileRepository,
        MediaFolderInterface $folderRepository,
        UploadsManager $uploadManager,
        ThumbnailService $thumbnailService
    ) {
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $folderRepository;
        $this->uploadManager = $uploadManager;
        $this->thumbnailService = $thumbnailService;

    }


    public function responseSuccess($data, $message = null)
    {
        return response()->json([
            'error' => false,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function responseError($message, $data = [], $code = null, $status = 200)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $status);
    }

    public function getAllImageSizes($url)
    {
        $images = [];
        foreach (config('media.sizes') as $size) {
            $readable_size = explode('x', $size);
            $images = get_image_url($url, $readable_size);
        }

        return $images;
    }

    public function handleUpload($fileUpload, $folder_id = 0)
    {
        /**
         * @var UploadedFile $fileUpload
         */
        try {
            $file = $this->fileRepository->getModel();

            $folder_path = str_finish($this->folderRepository->getFullPath($folder_id), '/');

            if ($fileUpload->getSize() / 1024 > (int)config('media.max_file_size_upload')) {
                return [
                    'error' => true,
                    'message' => trans('media::media.file_too_big', ['size' => config('media.max_file_size_upload')]),
                ];
            }

            $file_ext = $fileUpload->getClientOriginalExtension();

            $fileName = $this->fileRepository->createSlug(File::name($fileUpload->getClientOriginalName()), $file_ext, $this->uploadManager->uploadPath($folder_path));

            $path = $folder_path . $fileName;
            $content = File::get($fileUpload->getRealPath());

            $this->uploadManager->saveFile($path, $content);

            $data = $this->uploadManager->fileDetails($path);

            if (empty($data['mime_type'])) {
                return [
                    'error' => true,
                    'message' => trans('media::media.can_not_detect_file_type'),
                ];
            }

            $file->name = $this->fileRepository->createName(File::name($fileUpload->getClientOriginalName()), $folder_id);
            $file->url = $data['url'];
            $file->size = $data['size'];
            $file->mime_type = $data['mime_type'];

            $file->folder_id = $folder_id;
            $file->user_id = current_user_id();
            $file->options = request()->get('options', []);
            $file->is_public = request()->input('view_in') == 'public' ? 1 : 0;
            $this->fileRepository->createOrUpdate($file);

            if (is_image($this->uploadManager->fileMimeType($path))) {
                foreach (config('media.sizes') as $size) {
                    $readable_size = explode('x', $size);
                    $this->thumbnailService->setImage(ltrim($file->url, '/'))
                        ->setSize($readable_size[0], $readable_size[1])
                        ->setDestPath($this->uploadManager->uploadPath($folder_path))
                        ->setFileName(File::name($fileName) . '-' . $size . '.' . $file_ext)
                        ->save();
                }
            }

            return [
                'error' => false,
                'data' => $file,
            ];

        } catch (Exception $ex) {
            return [
                'error' => true,
                'message' => $ex->getMessage(),
            ];
        }
    }



    public function getServerConfigMaxUploadFileSize()
    {
        // Start with post_max_size.
        $max_size = $this->parseSize(ini_get('post_max_size'));

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = $this->parseSize(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }

        return $max_size;
    }

    public function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        }
        return round($size);
    }
}
