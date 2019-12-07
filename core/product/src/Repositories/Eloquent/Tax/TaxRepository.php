<?php
namespace Hydrogen\Product\Repositories\Eloquent\Tax;

use Hydrogen\Product\Models\Tax\Tax;
use Hydrogen\Product\Repositories\Contracts\Tax\TaxRepositoryInterface;
use Hydrogen\Product\Validators\Tax\TaxValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class TaxRepository extends BaseRepository implements TaxRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Tax::class;
    }

    public function validator()
    {
        return TaxValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}