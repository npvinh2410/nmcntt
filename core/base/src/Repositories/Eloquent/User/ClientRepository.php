<?php

namespace Hydrogen\Base\Repositories\Eloquent\User;


use Hydrogen\Base\Models\User\Client;
use Hydrogen\Base\Repositories\Contracts\User\ClientRepositoryInterface;
use Hydrogen\Base\Validators\ClientValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function model()
    {
        return Client::class;
    }

    public function validator()
    {
        return ClientValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}