<?php
namespace Hydrogen\Product\Repositories\Eloquent\Product;



use Hydrogen\Product\Models\Product\ProductTrans;
use Hydrogen\Product\Repositories\Contract\Product\ProductTransRepositoryInterface;
use Hydrogen\Product\Validators\Product\ProductTransValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class ProductTransRepository extends BaseRepository implements ProductTransRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return ProductTrans::class;
    }

    public function validator()
    {
        return ProductTransValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}