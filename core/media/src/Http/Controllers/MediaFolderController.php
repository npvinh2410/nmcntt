<?php

namespace Hydrogen\Media\Http\Controllers;

use Hydrogen\Media\Http\Requests\MediaFolderRequest;
use Hydrogen\Media\Repositories\Contracts\MediaFolderInterface;
use Hydrogen\Media\Repositories\Contracts\MediaFileInterface;
use Exception;
use Illuminate\Routing\Controller;
use Hydrogen\Media\Facades\HMediaFacade;

class MediaFolderController extends Controller
{
    protected $folderRepository;
    protected $fileRepository;

    public function __construct(MediaFolderInterface $folderRepository, MediaFileInterface $fileRepository)
    {
        $this->folderRepository = $folderRepository;
        $this->fileRepository = $fileRepository;
    }

    public function postCreate(MediaFolderRequest $request)
    {
        $name = $request->input('name');

        if (in_array($name, config('media.upload.reserved_names', []))) {
            return HMediaFacade::responseError(trans('media::media.name_reserved'));
        }

        try {
            $parent_id = $request->input('parent_id');

            $folder = $this->folderRepository->getModel();
            $folder->user_id = current_user_id();
            $folder->name = $this->folderRepository->createName($name, $parent_id);
            $folder->slug = $this->folderRepository->createSlug($name, $parent_id);
            $folder->parent_id = $parent_id;
            $this->folderRepository->createOrUpdate($folder);
            return HMediaFacade::responseSuccess([], trans('media::media.folder_created'));
        } catch (Exception $ex) {
            return HMediaFacade::responseError($ex->getMessage());
        }
    }
}
