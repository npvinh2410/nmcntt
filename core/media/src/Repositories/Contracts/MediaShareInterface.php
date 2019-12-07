<?php

namespace Hydrogen\Media\Repositories\Contracts;

interface MediaShareInterface extends RepositoryInterface
{
    public function getSharedFiles($folder_id = 0);
    public function getSharedFolders($folder_id = 0);
    public function getShareWithMeFiles($folder_id = 0);
    public function getSharedWithMeFolders($folder_id = 0);
    public function getSharedUsers($share_id, $share_type);
}
