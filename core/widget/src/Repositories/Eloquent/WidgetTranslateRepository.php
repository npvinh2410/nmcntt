<?php


namespace Hydrogen\Widget\Repositories\Eloquent;


use Hydrogen\Widget\Models\WidgetTranslate;
use Hydrogen\Widget\Repositories\Contracts\WidgetTranslateRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class WidgetTranslateRepository extends BaseRepository implements WidgetTranslateRepositoryInterface
{
    protected $cacheMinutes = 90;

    protected $cacheExcept = ['create', 'update', 'updateOrCreate', 'delete', 'deleteWhere'];


    use CacheableRepository;

    public function model()
    {
        return WidgetTranslate::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}