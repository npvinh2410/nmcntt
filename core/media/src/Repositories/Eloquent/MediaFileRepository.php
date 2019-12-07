<?php

namespace Hydrogen\Media\Repositories\Eloquent;

use Hydrogen\Media\Repositories\Contracts\MediaFileInterface;
use Illuminate\Support\Facades\Request;

class MediaFileRepository extends MediaBaseRepositories implements MediaFileInterface
{
    public function model()
    {

    }

    public function getSpaceUsed()
    {
        $data = $this->model->withTrashed();

        if (config('media.mode') != 'simple') {
            $data = $data->where('user_id', '=', current_user_id());
        }
        return $data->sum('size');
    }

    public function getSpaceLeft()
    {
        return $this->getQuota() - $this->getSpaceUsed();
    }

    public function getQuota()
    {
        // personal quota
        return current_user()->personal_quota;
    }

    public function getPercentageUsed()
    {
        if ($this->getQuota() === 0 || empty($this->getQuota())) {
            return round(100, 2);
        } else {
            return round(($this->getSpaceUsed() / $this->getQuota()) * 100, 2);
        }
    }

    public function createName($name, $folder)
    {
        $index = 1;
        $baseName = $name;
        while ($this->checkIfExistsName($name, $folder)) {
            $name = $baseName . '-' . $index++;
        }
        return $name;
    }

    protected function checkIfExistsName($name, $folder)
    {
        $count = $this->model->where('name', '=', $name)->where('folder_id', '=', $folder)->withTrashed();
        if (config('media.mode') != 'simple') {
            $count = $count->where('user_id', '=', current_user_id());
        }

        $count = $count->count();

        return $count > 0;
    }

    public function createSlug($name, $extension, $folder_path)
    {
        $slug = str_slug($name);
        $index = 1;
        $baseSlug = $slug;
        while (file_exists($folder_path . '/' . $slug . '.' . $extension)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = $slug . '-' . time();
        }

        return $slug . '.' . $extension;
    }

    public function getFilesByFolderId($folder_id, array $params = [])
    {
        $params = array_merge([
            'order_by' => [
                'name' => 'ASC',
            ],
            'select' => [
                'id',
                'name',
                'url',
                'mime_type',
                'size',
                'created_at',
                'updated_at',
                'focus',
                'options',
                'folder_id',
                'is_public',
            ],
            'where' => [],
            'is_public' => false,
        ], $params);

        $files = $this->model->where($params['where']);

        if (config('media.mode') != 'simple') {
            if ($params['is_public'] == true) {
                $files = $files->where('is_public', '=', 1);
            } else {
                $files = $files->where('user_id', '=', current_user_id());
            }
        }

        if ($folder_id != -1) {
            $files = $files->where('folder_id', '=', $folder_id);
        }

        if (isset($params['recent_items'])) {
            $files = $files->whereIn('id', array_get($params, 'recent_items', []));
        }

        $files = $files->select($params['select']);

        foreach ($params['order_by'] as $by => $direction) {
            $files = $files->orderBy($by, strtoupper($direction));
        }

        if (Request::has('selected_file_id')) {
            $files->where('id', '<>', Request::input('selected_file_id'));
            if (!Request::has('paged') || Request::input('paged') == 1) {
                $current_file = $this->model->where('folder_id', '=', $folder_id)->whereId(Request::input('selected_file_id'))->first();
            }
        }
        $posts_per_page = Request::has('posts_per_page') && Request::input('posts_per_page') > 0 ? Request::input('posts_per_page') : config('media.pagination.per_page');
        $paged = Request::has('paged') && Request::input('paged') > 0 ? Request::input('paged') : config('media.pagination.per_page');
        $files->skip(($paged - 1) * $posts_per_page)->limit($posts_per_page);

        $data = $files->get();

        if (isset($current_file)) {
            try {
                $data->prepend($current_file);
            } catch (Exception $e) {
                info('Error when prepend data');
            }
        }
        return $data;
    }

    public function getTrashed($folder_id, array $params = [])
    {
        $params = array_merge([
            'order_by' => [
                'name' => 'ASC',
            ],
            'select' => [
                'id',
                'name',
                'url',
                'mime_type',
                'size',
                'created_at',
                'updated_at',
                'options',
                'folder_id',
            ],
            'where' => [],
        ], $params);

        $files = $this->model
            ->where(function ($query) use ($params, $folder_id) {
                return $query->orWhere('folder_id', $folder_id)
                    ->orWhereNotIn('folder_id', $params['whereNotIn']);
            })
            ->where($params['where']);

        if (config('media.mode') != 'simple') {
            $files = $files->where('user_id', current_user_id());
        }

        $files = $files->select($params['select']);

        foreach ($params['order_by'] as $by => $direction) {
            $files = $files->orderBy($by, strtoupper($direction));
        }

        return $files->onlyTrashed()->get();
    }

    public function emptyTrash()
    {
        $files = $this->model->onlyTrashed();

        if (config('media.mode') != 'simple') {
            $files = $files->where('user_id', current_user_id());
        }

        $files = $files->get();

        foreach ($files as $file) {
            $file->forceDelete();
        }
        return true;
    }
}
