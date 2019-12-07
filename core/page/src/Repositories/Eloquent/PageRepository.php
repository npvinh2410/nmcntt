<?php
namespace Hydrogen\Page\Repositories\Eloquent;

use Hydrogen\Page\Models\Page;
use Hydrogen\Page\Validators\PageValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hydrogen\Page\Repositories\Contracts\PageRepositoryInterface;
use Prettus\Repository\Traits\CacheableRepository;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Page::class;
    }

    public function validator()
    {
        return PageValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}