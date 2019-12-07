<?php
namespace Hydrogen\Base\Repositories\Eloquent\Auth;

use Hydrogen\Base\Models\Auth\Role;
use Hydrogen\Base\Repositories\Contracts\Auth\RoleRepositoryInterface;
use Hydrogen\Base\Validators\RoleValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function model()
    {
        return Role::class;
    }

    public function validator()
    {
        return RoleValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}