<?php

namespace Hydrogen\Media\Repositories\Contracts;

interface MediaFolderInterface extends RepositoryInterface
{
    public function getFolderByParentId($folder_id, array $params = [], $withTrash = false);
    public function createSlug($name, $parent_id);
    public function createName($name, $parent_id);
    public function getBreadcrumbs($parent_id, $breadcrumbs = []);
    public function getTrashed($parent_id, array $params = []);
    public function deleteFolder($folder_id, $force = false);
    public function getAllChildFolders($parent_id, $child = []);
    public function getFullPath($folder_id, $path = '');
    public function restoreFolder($folder_id);
    public function emptyTrash();
}
