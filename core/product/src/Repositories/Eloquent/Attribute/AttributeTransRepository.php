<?php
namespace Hydrogen\Product\Repositories\Eloquent\Attribute;

use Hydrogen\Product\Models\Attribute\AttributeTrans;
use Hydrogen\Product\Repositories\Contract\Attribute\AttributeTransRepositoryInterface;
use Hydrogen\Product\Validators\Attribute\AttributeTransValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class AttributeTransRepository extends BaseRepository implements AttributeTransRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return AttributeTrans::class;
    }

    public function validator()
    {
        return AttributeTransValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}