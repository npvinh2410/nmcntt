<?php
namespace Hydrogen\Product\Repositories\Eloquent\Attribute;

use Hydrogen\Product\Models\Attribute\AttributeValue;
use Hydrogen\Product\Repositories\Contract\Attribute\AttributeValueRepositoryInterface;
use Hydrogen\Product\Validators\Attribute\AttributeValueValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return AttributeValue::class;
    }

    public function validator()
    {
        return AttributeValueValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}