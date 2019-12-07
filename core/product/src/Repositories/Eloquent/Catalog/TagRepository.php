<?php
namespace Hydrogen\Product\Repositories\Eloquent\Catalog;

use Hydrogen\Product\Models\Catalog\Tag;
use Hydrogen\Product\Repositories\Contract\Catalog\TagRepositoryInterface;
use Hydrogen\Product\Validators\Catalog\TagValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Tag::class;
    }

    public function validator()
    {
        return TagValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}