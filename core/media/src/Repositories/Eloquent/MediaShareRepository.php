<?php

namespace Hydrogen\Media\Repositories\Eloquent;

use Hydrogen\Media\Repositories\Contracts\MediaShareInterface;

class MediaShareRepository extends MediaBaseRepositories implements MediaShareInterface
{

    public function getSharedFiles($folder_id = 0)
    {
        return $this->model->join('media_files', 'media_files.id', '=', 'media_shares.share_id')
            ->where([
                'media_shares.share_type' => 'file',
                'media_shares.shared_by' => current_user_id(),
                'media_files.folder_id' => $folder_id,
            ])
            ->select(['media_shares.share_id', 'media_files.*'])
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();
    }

    public function getSharedFolders($folder_id = 0)
    {

        return $this->model->join('media_folders', 'media_folders.id', '=', 'media_shares.share_id')
            ->where([
                'media_shares.share_type' => 'folder',
                'media_shares.shared_by' => current_user_id(),
                'media_folders.parent_id' => $folder_id,
            ])
            ->select(['media_shares.share_id', 'media_folders.*'])
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();
    }

    public function getShareWithMeFiles($folder_id = 0)
    {
        return $this->model->join('media_files', 'media_files.id', '=', 'media_shares.share_id')
            ->where([
                'media_shares.share_type' => 'file',
                'media_shares.user_id' => current_user_id(),
                'media_files.folder_id' => $folder_id,
            ])
            ->select(['media_shares.share_id', 'media_files.*'])
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();
    }

    public function getSharedWithMeFolders($folder_id = 0)
    {

        return $this->model->join('media_folders', 'media_folders.id', '=', 'media_shares.share_id')
            ->where([
                'media_shares.share_type' => 'folder',
                'media_shares.user_id' => current_user_id(),
                'media_folders.parent_id' => $folder_id,
            ])
            ->select(['media_shares.share_id', 'media_folders.*'])
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();
    }

    public function getSharedUsers($share_id, $share_type)
    {
        return $this->model->join('users', 'users.id', '=', 'media_shares.user_id')
            ->where([
                'shared_by' => current_user_id(),
                'share_type' => $share_type,
                'share_id' => $share_id,
            ])
            ->selectRaw(config('media.user_attributes'))
            ->get();
    }
}
