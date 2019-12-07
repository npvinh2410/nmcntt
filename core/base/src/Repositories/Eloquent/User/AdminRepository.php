<?php

namespace Hydrogen\Base\Repositories\Eloquent\User;


use Hydrogen\Base\Models\User\Admin;
use Hydrogen\Base\Repositories\Contracts\User\AdminRepositoryInterface;
use Hydrogen\Base\Validators\AdminValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function model()
    {
        return Admin::class;
    }

    public function validator()
    {
        return AdminValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}