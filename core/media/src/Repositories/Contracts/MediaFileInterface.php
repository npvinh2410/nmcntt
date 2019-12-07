<?php
namespace Hydrogen\Media\Repositories\Contracts;

interface MediaFileInterface extends RepositoryInterface
{
    public function getSpaceUsed();
    public function getSpaceLeft();
    public function getQuota();
    public function getPercentageUsed();
    public function createName($name, $folder);
    public function createSlug($name, $extension, $folder);
    public function getFilesByFolderId($folder_id, array $params = []);
    public function getTrashed($folder_id, array $params = []);
    public function emptyTrash();
}
