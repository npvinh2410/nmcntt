<?php

namespace Hydrogen\Media\Http\Controllers;

use Hydrogen\Media\Http\Requests\MediaFileRequest;
use Hydrogen\Media\Repositories\Contracts\MediaFileInterface;
use Hydrogen\Media\Repositories\Contracts\MediaFolderInterface;
use Hydrogen\Media\Services\UploadsManager;
use Hydrogen\Media\Facades\HMediaFacade;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class MediaFileController extends Controller
{
    protected $uploadManager;
    protected $fileRepository;
    protected $folderRepository;
    public function __construct(
        MediaFileInterface $fileRepository,
        MediaFolderInterface $folderRepository,
        UploadsManager $uploadManager
    )
    {
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $folderRepository;
        $this->uploadManager = $uploadManager;
    }

    public function postAddExternalService(Request $request)
    {
        $type = $request->input('type');
        if (!in_array($type, config('media.external_services'))) {
            return HMediaFacade::responseError(trans('media::media.invalid_request'));
        }

        $file = $this->fileRepository->getModel();
        $file->name = $this->fileRepository->createName($request->input('name'), $request->input('folder_id'));
        $file->url = $request->input('url');
        $file->size = 0;
        $file->mime_type = $type;
        $file->folder_id = $request->input('folder_id');
        $file->user_id = current_user_id();
        $file->options = $request->input('options', []);
        $file->is_public = $request->input('view_in') == 'public' ? 1 : 0;
        $this->fileRepository->createOrUpdate($file);

        return HMediaFacade::responseSuccess(trans('media::media.add_success'));
    }

    public function postUpload(MediaFileRequest $request)
    {
        $result = HMediaFacade::handleUpload(array_first($request->file('file')), $request->input('folder_id', 0));

        if ($result['error'] == false) {
            return HMediaFacade::responseSuccess([
                'id' => $result['data']->id,
            ]);
        }

        return HMediaFacade::responseError($result['message']);
    }

    public function postUploadFromEditor(MediaFileRequest $request)
    {
        $result = HMediaFacade::handleUpload($request->file('upload'));

        if ($result['error'] == false) {
            $file = $result['data'];
            if ($request->input('upload_type') == 'tinymce') {
                return response('<script>parent.setImageValue("' . url($file->url) . '"); </script>')->header('Content-Type', 'text/html');
            } else {
                return response('<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("' . $request->input('CKEditorFuncNum') . '", "' . url($file->url) . '", "");</script>')->header('Content-Type', 'text/html');
            }
        }
        return response('<script>alert("' . array_get($result, 'message') . '")</script>')->header('Content-Type', 'text/html');
    }
}
