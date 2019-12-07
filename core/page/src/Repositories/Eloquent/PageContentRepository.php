<?php
namespace Hydrogen\Page\Repositories\Eloquent;

use Hydrogen\Page\Models\PageContent;
use Hydrogen\Page\Repositories\Contracts\PageContentRepositoryInterface;
use Hydrogen\Page\Validators\PageContentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class PageContentRepository extends BaseRepository implements PageContentRepositoryInterface
{

    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return PageContent::class;
    }

    public function validator()
    {
        return PageContentValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}