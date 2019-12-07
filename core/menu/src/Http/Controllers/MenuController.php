<?php
namespace Hydrogen\Menu\Http\Controllers;

use App\Http\Controllers\Controller;

use Hydrogen\Menu\Repositories\Eloquent\MenuRepository;
use Hydrogen\Page\Repositories\Eloquent\PageRepository;
use Hydrogen\Post\Repositories\Eloquent\CategoryRepository;
use Hydrogen\Product\Repositories\Eloquent\Catalog\CatalogRepository;
use Hydrogen\Product\Repositories\Eloquent\ProductCategoryRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller {

    protected $menuRepository;
    // page
    protected $pageRepository;
    // post
    protected $categoryRepository;
    // product
    protected $catalogRepository;

    public function __construct(
        MenuRepository $menuRepository,
        PageRepository $pageRepository,
        CategoryRepository $categoryRepository,
        CatalogRepository $catalogRepository
    ){
        $this->menuRepository = $menuRepository;

        $this->pageRepository = $pageRepository;

        $this->categoryRepository = $categoryRepository;

        $this->catalogRepository = $catalogRepository;
    }

    public function index()
    {
        hydrogen_authorize('menus-index');

        $menus = $this->menuRepository->all();
        return view('menu::index', ['menus' => $menus]);
    }

    public function create()
    {
        hydrogen_authorize('menus-create');

        $pages = $this->pageRepository->all();
        $categories = $this->categoryRepository->all();
        $catalogs = $this->catalogRepository->all();

        return view('menu::create', compact("pages","categories", "catalogs"));
    }

    public function store(Request $request)
    {
        hydrogen_authorize('menus-create');

        $menu_params = [
            'name' => $request->name,
            'data' => $request->menu_data,
            'position' => $request->position,
        ];


        $this->menuRepository->create($menu_params);

        Session::flash('flash', ['success' => 'Menu created successfully']);
        return redirect()->route('menus.index');
    }

    public function show($id)
    {
        hydrogen_authorize('menus-show');

        $menu = $this->menuRepository->find($id);
        return view('menu::show', compact("menu"));
    }

    public function edit($id)
    {
        hydrogen_authorize('menus-edit');

        $menu = $this->menuRepository->find($id);
        $pages = $this->pageRepository->all();
        $categories = $this->categoryRepository->all();
        $catalogs = $this->catalogRepository->all();
        return view('menu::edit', compact("menu", "pages", "categories", "catalogs"));
    }

    public function update(Request $request, $id)
    {
        hydrogen_authorize('menus-edit');

        $menu_params = [
            'name' => $request->name,
            'data' => $request->menu_data,
            'position' => $request->position,
        ];

        $this->menuRepository->update($menu_params, $id);

        Session::flash('flash', ['success' => 'Menu updated successfully']);
        return redirect()->route('menus.index');
    }

    public function destroy($id)
    {
        hydrogen_authorize('menus-destroy');

        $this->menuRepository->delete($id);
        Session::flash('flash', ['success' => 'Menu deleted successfully']);
        return redirect()->route('menus.index');
    }
}