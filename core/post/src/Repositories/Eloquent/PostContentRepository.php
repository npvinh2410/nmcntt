<?php
namespace Hydrogen\Post\Repositories\Eloquent;

use Hydrogen\Post\Models\PostContent;
use Hydrogen\Post\Repositories\Contracts\PostContentRepositoryInterface;
use Hydrogen\Post\Validators\PostContentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class PostContentRepository extends BaseRepository implements PostContentRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return PostContent::class;
    }

    public function validator()
    {
        return PostContentValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}