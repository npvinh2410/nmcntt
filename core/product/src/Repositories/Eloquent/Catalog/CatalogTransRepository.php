<?php
namespace Hydrogen\Product\Repositories\Eloquent\Catalog;

use Hydrogen\Product\Models\Catalog\CatalogTrans;
use Hydrogen\Product\Repositories\Contract\Catalog\CatalogTransRepositoryInterface;
use Hydrogen\Product\Validators\Catalog\CatalogTransValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class CatalogTransRepository extends BaseRepository implements CatalogTransRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return CatalogTrans::class;
    }

    public function validator()
    {
        return CatalogTransValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}