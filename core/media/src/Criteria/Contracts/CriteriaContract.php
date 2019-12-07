<?php

namespace Hydrogen\Media\Criteria\Contracts;

use Hydrogen\Media\Repositories\Contracts\RepositoryInterface;

interface CriteriaContract
{
    public function apply($model, RepositoryInterface $repository);
}
