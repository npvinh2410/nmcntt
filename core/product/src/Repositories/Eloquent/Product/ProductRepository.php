<?php
namespace Hydrogen\Product\Repositories\Eloquent\Product;


use Hydrogen\Product\Models\Product\Product;
use Hydrogen\Product\Repositories\Contract\Product\ProductRepositoryInterface;
use Hydrogen\Product\Validators\Product\ProductValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Product::class;
    }

    public function validator()
    {
        return ProductValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}