<?php
namespace Hydrogen\Product\Repositories\Eloquent\Product;

use Hydrogen\Product\Models\Product\ProductImage;
use Hydrogen\Product\Repositories\Contract\Product\ProductImageRepositoryInterface;
use Hydrogen\Product\Validators\Product\ProductImageValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return ProductImage::class;
    }

    public function validator()
    {
        return ProductImageValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}