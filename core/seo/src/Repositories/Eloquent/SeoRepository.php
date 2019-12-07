<?php
namespace Hydrogen\Seo\Repositories\Eloquent;


use Hydrogen\Seo\Validators\SeoValidator;
use Hydrogen\Seo\Models\Seo;
use Hydrogen\Seo\Repositories\Contracts\SeoRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class SeoRepository extends BaseRepository implements SEORepositoryInterface {
    public function model()
    {
        return SEO::class;
    }

    public function validator()
    {
        return SEOValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}