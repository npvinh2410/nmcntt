<?php


namespace Hydrogen\Widget\Repositories\Eloquent;


use Hydrogen\Widget\Validators\WidgetValidator;
use Hydrogen\Widget\Models\Widget;
use Hydrogen\Widget\Repositories\Contracts\WidgetRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class WidgetRepository extends BaseRepository implements WidgetRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return Widget::class;
    }

    public function validator()
    {
        return WidgetValidator::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}