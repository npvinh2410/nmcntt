<?php
namespace Hydrogen\Slider\Repositories\Eloquent;

use Hydrogen\Slider\Models\Slide;
use Hydrogen\Slider\Repositories\Contracts\SlideRepositoryInterface;
use Hydrogen\Slider\Validators\SlideValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class SlideRepository extends BaseRepository implements SlideRepositoryInterface
{
    public function model()
    {
        return Slide::class;
    }

    public function validator()
    {
        return SlideValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}