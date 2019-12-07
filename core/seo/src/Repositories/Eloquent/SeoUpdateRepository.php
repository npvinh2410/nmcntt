<?php
namespace Hydrogen\Seo\Repositories\Eloquent;

use Hydrogen\Seo\Repositories\Contracts\SeoUpdateRepositoryInterface;
use Hydrogen\Seo\Validators\SeoUpdateValidator;
use Hydrogen\Seo\Models\SeoUpdate;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class SeoUpdateRepository extends BaseRepository implements SeoUpdateRepositoryInterface
{

    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return SeoUpdate::class;
    }

    public function validator()
    {
        return SeoUpdateValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}