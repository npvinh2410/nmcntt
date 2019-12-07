<?php
namespace Hydrogen\Post\Repositories\Eloquent;

use Hydrogen\Post\Models\Post;
use Hydrogen\Post\Repositories\Contracts\PostRepositoryInterface;
use Hydrogen\Post\Validators\PostValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Post::class;
    }

    public function validator()
    {
        return PostValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}