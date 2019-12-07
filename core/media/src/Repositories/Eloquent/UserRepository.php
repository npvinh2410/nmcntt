<?php

namespace Hydrogen\Media\Repositories\Eloquent;

use Hydrogen\Media\Repositories\Contracts\UserInterface;

class UserRepository extends MediaBaseRepositories implements UserInterface
{
    public function getListUsers()
    {
        return $this->model->where('id', '!=', current_user_id())->selectRaw(config('media.user_attributes'))->get();
    }
}
