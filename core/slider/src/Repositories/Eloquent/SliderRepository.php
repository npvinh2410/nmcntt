<?php
namespace Hydrogen\Slider\Repositories\Eloquent;

use Hydrogen\Slider\Models\Slider;
use Hydrogen\Slider\Repositories\Contracts\SliderRepositoryInterface;
use Hydrogen\Slider\Validators\SliderValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{
    public function model()
    {
        return Slider::class;
    }

    public function validator()
    {
        return SliderValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}