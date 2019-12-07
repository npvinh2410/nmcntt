<?php

namespace Hydrogen\Media\Repositories\Eloquent;

use Hydrogen\Media\Criteria\Contracts\CriteriaContract;
use Hydrogen\Media\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;


abstract class MediaBaseRepositories implements RepositoryInterface
{
    protected $model;
    protected $originalModel;
    protected $criteria = [];
    protected $skipCriteria = false;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getTable()
    {
        return $this->model->getTable();
    }
    public function getCriteria()
    {
        return $this->criteria;
    }
    public function pushCriteria(CriteriaContract $criteria)
    {
        $this->criteria[get_class($criteria)] = $criteria;
        return $this;
    }
    public function dropCriteria($criteria)
    {
        $className = $criteria;
        if (is_object($className)) {
            $className = get_class($criteria);
        }

        if (isset($this->criteria[$className])) {
            unset($this->criteria[$className]);
        }
        return $this;
    }
    public function skipCriteria($bool = true)
    {
        $this->skipCriteria = $bool;
        return $this;
    }
    protected function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }
        $criteria = $this->getCriteria();
        if ($criteria) {
            foreach ($criteria as $className => $cr) {
                $this->model = $cr->apply($this->model, $this);
            }
        }

        return $this;
    }
    public function getByCriteria(CriteriaContract $criteria)
    {
        return $criteria->apply($this->originalModel, $this);
    }
    public function getFirstBy(array $condition = [], array $select = ['*'], array $with = [])
    {
        $this->applyCriteria();

        $this->make($with);

        if (!empty($select)) {
            $data = $this->model->where($condition)->select($select)->first();
        } else {
            $data = $this->model->where($condition)->first();
        }

        $this->resetModel();

        return $data;
    }
    public function make(array $with = [])
    {
        $this->model = $this->model->with($with);
        return $this->model;
    }
    public function findById($id, array $with = [])
    {
        $this->applyCriteria();

        $data = $this->make($with)->where('id', $id)->first();
        $this->resetModel();
        return $data;
    }
    public function all(array $with = [])
    {
        $this->applyCriteria();

        $data = $this->make($with)->get();

        $this->resetModel();

        return $data;
    }
    public function pluck($column, $key = null)
    {
        $this->applyCriteria();

        $data = $this->model->pluck($column, $key)->all();

        $this->resetModel();

        return $data;
    }
    public function allBy(array $condition, array $with = [], array $select = ['*'])
    {
        $this->applyCriteria();

        $this->applyConditions($condition);

        $data = $this->make($with)->select($select)->get();
        $this->resetModel();
        return $data;
    }
    public function bySlug($slug, array $with = [])
    {
        $this->applyCriteria();

        $data = $this->make($with)->where('slug', '=', $slug)->first();

        $this->resetModel();

        return $data;
    }
    public function create(array $data)
    {
        $data = $this->model->create($data);
        $this->resetModel();
        return $data;
    }
    public function createOrUpdate($data, $condition = [])
    {
        /**
         * @var Model $item
         */
        if (is_array($data)) {
            if (empty($condition)) {
                $item = new $this->model;
            } else {
                $item = $this->getFirstBy($condition);
            }
            if (empty($item)) {
                $item = new $this->model;
            }

            $item = $item->fill($data);
        } elseif ($data instanceof Model) {
            $item = $data;
        } else {
            return false;
        }

        if ($item->save()) {
            $this->resetModel();
            return $item;
        }

        $this->resetModel();

        return false;
    }
    public function delete(Model $model)
    {
        return $model->delete();
    }
    public function firstOrCreate(array $data, array $with = [])
    {
        $this->applyCriteria();

        $data = $this->model->firstOrCreate($data, $with);

        $this->resetModel();

        return $data;
    }
    public function update(array $condition, array $data)
    {
        $data = $this->model->where($condition)->update($data);
        $this->resetModel();
        return $data;
    }
    public function select(array $select = ['*'], array $condition = [])
    {
        $data = $this->model->where($condition)->select($select);
        $this->resetModel();
        return $data;
    }
    public function deleteBy(array $condition = [])
    {
        $this->applyConditions($condition);

        $data = $this->model->get();

        if (empty($data)) {
            return false;
        }
        foreach ($data as $item) {
            $item->delete();
        }
        $this->resetModel();
        return true;
    }
    public function count(array $condition = [])
    {
        $this->applyConditions($condition);
        $this->applyCriteria();
        $data = $this->model->count();

        $this->resetModel();

        return $data;
    }
    public function getByWhereIn($column, array $value = [], array $args = [])
    {
        $this->model = $this->model->whereIn($column, $value);

        if (!empty(array_get($args, 'where'))) {
            $this->applyConditions($args['where']);
        }

        if (!empty(array_get($args, 'paginate'))) {
            $data = $this->model->paginate($args['paginate']);
        } elseif (!empty(array_get($args, 'limit'))) {
            $data = $this->model->limit($args['limit']);
        } else {
            $data = $this->model->get();
        }

        $this->resetModel();

        return $data;
    }

    public function resetModel()
    {
        $this->model = $this->originalModel;
        $this->skipCriteria = false;
        $this->criteria = [];
        return $this;
    }
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                switch (strtoupper($condition)) {
                    case 'IN':
                        $this->model = $this->model->whereIn($field, $val);
                        break;
                    case 'NOT_IN':
                        $this->model = $this->model->whereNotIn($field, $val);
                        break;
                    default:
                        $this->model = $this->model->where($field, $condition, $val);
                        break;
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    public function advancedGet(array $params = [])
    {
        $this->applyCriteria();

        $params = array_merge([
            'condition' => [],
            'order_by' => [],
            'take' => null,
            'paginate' => [
                'per_page' => null,
                'current_paged' => 1,
            ],
            'select' => ['*'],
            'with' => [],
        ], $params);

        $this->applyConditions($params['condition']);

        if ($params['select']) {
            $this->model = $this->model->select($params['select']);
        }

        foreach ($params['order_by'] as $column => $direction) {
            $this->model = $this->model->orderBy($column, $direction);
        }

        foreach ($params['with'] as $with) {
            $this->model = $this->model->with($with);
        }

        if ($params['take'] == 1) {
            $result = $this->model->first();
        } elseif ($params['take']) {
            $result = $this->model->take($params['take'])->get();
        } elseif ($params['paginate']['per_page']) {
            $result = $this->model->paginate($params['paginate']['per_page'], ['*'], 'page', $params['paginate']['current_paged']);
        } else {
            $result = $this->model->get();
        }

        $this->resetModel();

        return $result;
    }
    public function forceDelete(array $condition = [])
    {
        $item = $this->model->where($condition)->withTrashed()->first();
        if (!empty($item)) {
            $item->forceDelete();
        }
    }
    public function restoreBy(array $condition = [])
    {
        $item = $this->model->where($condition)->withTrashed()->first();
        if (!empty($item)) {
            $item->restore();
        }
    }
    public function getFirstByWithTrash(array $condition = [], array $select = [])
    {
        $query = $this->model->where($condition)->withTrashed();

        if (!empty($select)) {
            return $query->select($select)->first();
        }

        return $query->first();
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }
    public function firstOrNew(array $condition)
    {
        $this->applyConditions($condition);

        $result = $this->model->first() ?: new $this->originalModel;

        $this->resetModel();

        return $result;
    }
}
