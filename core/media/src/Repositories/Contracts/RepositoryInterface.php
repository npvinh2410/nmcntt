<?php

namespace Hydrogen\Media\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getModel();
    public function getTable();
    public function make(array $with = []);
    public function getFirstBy(array $condition = [], array $select = [], array $with = []);
    public function findById($id, array $with = []);
    public function pluck($column, $key = null);
    public function all(array $with = []);
    public function allBy(array $condition, array $with = [], array $select = ['*']);
    public function bySlug($slug, array $with = []);
    public function create(array $data);
    public function createOrUpdate($data, $condition = []);
    public function delete(Model $model);
    public function firstOrCreate(array $data, array $with = []);
    public function update(array $condition, array $data);
    public function select(array $select = ['*'], array $condition = []);
    public function deleteBy(array $condition = []);
    public function count(array $condition = []);
    public function getByWhereIn($column, array $value = [], array $args = []);
    public function advancedGet(array $params = []);
    public function forceDelete(array $condition = []);
    public function restoreBy(array $condition = []);
    public function getFirstByWithTrash(array $condition = [], array $select = []);
    public function insert(array $data);
}
