<?php
namespace Hydrogen\Product\Repositories\Eloquent\Catalog;

use Hydrogen\Product\Models\Catalog\Catalog;
use Hydrogen\Product\Repositories\Contract\Catalog\CatalogRepositoryInterface;
use Hydrogen\Product\Validators\Catalog\CatalogValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class CatalogRepository extends BaseRepository implements CatalogRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Catalog::class;
    }

    public function validator()
    {
        return CatalogValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}