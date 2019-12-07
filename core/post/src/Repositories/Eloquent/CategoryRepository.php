<?php
namespace Hydrogen\Post\Repositories\Eloquent;

use Hydrogen\Post\Models\Category;
use Hydrogen\Post\Repositories\Contracts\CategoryRepositoryInterface;
use Hydrogen\Post\Validators\CategoryValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hydrogen\Page\Repositories\Contracts\PageTranslationRepositoryInterface;
use Prettus\Repository\Traits\CacheableRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Category::class;
    }

    public function validator()
    {
        return CategoryValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}