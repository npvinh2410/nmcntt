<?php
namespace Hydrogen\Product\Repositories\Eloquent\Catalog;

use Hydrogen\Product\Models\Catalog\TagTrans;
use Hydrogen\Product\Repositories\Contract\Catalog\TagTransRepositoryInterface;;
use Hydrogen\Product\Validators\Catalog\TagTransValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class TagTransRepository extends BaseRepository implements TagTransRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return TagTrans::class;
    }

    public function validator()
    {
        return TagTransValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}