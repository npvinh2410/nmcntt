<?php


namespace Hydrogen\Base\Repositories\Eloquent\Auth;

use Hydrogen\Base\Models\Auth\Permission;
use Hydrogen\Base\Repositories\Contracts\Auth\PermissionRepositoryInterface;
use Hydrogen\Base\Validators\PermissionValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return Permission::class;
    }

    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}