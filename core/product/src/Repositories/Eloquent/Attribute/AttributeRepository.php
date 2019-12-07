<?php
namespace Hydrogen\Product\Repositories\Eloquent\Attribute;

use Hydrogen\Product\Models\Attribute\Attribute;
use Hydrogen\Product\Repositories\Contract\Attribute\AttributeRepositoryInterface;
use Hydrogen\Product\Validators\Attribute\AttributeValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Attribute::class;
    }

    public function validator()
    {
        return AttributeValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}