<?php
namespace Hydrogen\Post\Repositories\Eloquent;

use Hydrogen\Post\Models\CategoryContent;
use Hydrogen\Post\Repositories\Contracts\CategoryContentRepositoryInterface;
use Hydrogen\Post\Validators\CategoryContentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class CategoryContentRepository extends BaseRepository implements CategoryContentRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return CategoryContent::class;
    }

    public function validator()
    {
        return CategoryContentValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}