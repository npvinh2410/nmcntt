<?php

namespace Hydrogen\Setting\Repositories\Eloquent;

use Hydrogen\Setting\Models\Setting;
use Hydrogen\Setting\Repositories\Contracts\SettingRepositoryInterface;
use Hydrogen\Setting\Validators\SettingValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function model()
    {
        return Setting::class;
    }

    public function validator()
    {
        return SettingValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}