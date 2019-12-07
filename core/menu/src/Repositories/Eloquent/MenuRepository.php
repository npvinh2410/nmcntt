<?php
namespace Hydrogen\Menu\Repositories\Eloquent;

use Hydrogen\Menu\Models\Menu;
use Hydrogen\Menu\Repositories\Contracts\MenuRepositoryInterface;
use Hydrogen\Menu\Validators\MenuValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function model()
    {
        return Menu::class;
    }

    public function validator()
    {
        return MenuValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}