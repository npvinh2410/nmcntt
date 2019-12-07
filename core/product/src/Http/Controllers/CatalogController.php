<?php

namespace Hydrogen\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Product\Repositories\Eloquent\Catalog\CatalogRepository;
use Hydrogen\Product\Repositories\Eloquent\Catalog\CatalogTransRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    protected $catalogRepository;
    protected $catalogTransRepository;
    protected $seoRepository;

    public function __construct(CatalogRepository $catalogRepository,
                                CatalogTransRepository $catalogTransRepository,
                                SeoRepository $seoRepository)
    {
        $this->catalogRepository = $catalogRepository;
        $this->catalogTransRepository = $catalogTransRepository;
        $this->seoRepository = $seoRepository;
    }

    public function index()
    {
        hydrogen_authorize('catalogs-index');

        $catalogs = $this->catalogRepository->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->paginate(20);

        return view('product::catalog.index', ['catalogs' => $catalogs]);
    }

    public function create()
    {
        hydrogen_authorize('catalogs-create');

        $catalogs = $this->catalogRepository->all();

        return view('product::catalog.create', ['catalogs' => $catalogs]);
    }

    public function store(Request $request)
    {
        hydrogen_authorize('catalogs-create');

        $catalog_param = [
            'parent_id' => $request->parent,
        ];

        $catalog = $this->catalogRepository->create($catalog_param);

        $catalogTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'lang_code' => get_default_lang_code(),
            'catalog_id' => $catalog->id,
        ];

        $this->catalogTransRepository->create($catalogTrans_param);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => get_default_lang_code(),
            'owner_type' => 'catalog',
            'owner_id' => $catalog->id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Catalog created successfully']);
        return redirect()->route('catalogs.index');

    }

    public function show($id, $lang_code)
    {
        hydrogen_authorize('catalogs-show');

        $catalog = $this->catalogRepository->find($id);

        return view('product::catalog.show', ['catalog' => $catalog, 'lang_code' => $lang_code]);
    }

    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-create');

        $catalog = $this->catalogRepository->find($id);;

        return view('product::catalog.trans', [
            'catalog' => $catalog,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-create');

        $catalogTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'lang_code' => $request->lang_code,
            'catalog_id' => $id,
        ];

        $this->catalogTransRepository->create($catalogTrans_param);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => $request->lang_code,
            'owner_type' => 'catalog',
            'owner_id' => $id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Catalog created successfully']);
        return redirect()->route('catalogs.index');
    }

    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-edit');

        $catalog = $this->catalogRepository->find($id);
        $catalogs = $this->catalogRepository->findWhere([
            ['id', '!=', $id]
        ]);

        return view('product::catalog.edit', [
            'catalog' => $catalog,
            'catalogs' => $catalogs,
            'lang_code' => $lang_code,
        ]);
    }

    public function update(Request $request, $id, $lang_code)
    {

        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-edit');

        $catalog = $this->catalogRepository->find($id);



        if(isset($request->parent))
        {
            $catalog_param['parent_id'] = $request->parent;

            $this->catalogRepository->update($catalog_param, $id);
        }

        $catalogTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
        ];

        $this->catalogTransRepository->update($catalogTrans_param, $catalog->translate($lang_code)->id);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
        ];

        $this->seoRepository->update($seo_param, $catalog->seos($lang_code)->id);


        Session::flash('flash', ['success' => 'Catalog updated successfully']);
        return redirect()->route('catalogs.index');
    }

    public function destroy(Request $request, $id) {
        hydrogen_authorize('catalogs-destroy');

        $catalog = $this->catalogRepository->find($id);

        if($request->lang_code)
        {
            $this->seoRepository->delete($catalog->seos($request->lang_code)->id);
            $this->catalogTransRepository->delete($catalog->translate($request->lang_code)->id);
        }
        else
        {
            $this->seoRepository->deleteWhere(['owner_type' => 'catalog', 'owner_id' => $id]);
            $this->catalogTransRepository->deleteWhere(['catalog_id' => $id]);
            $this->catalogRepository->delete($id);
        }
        Session::flash('flash', ['success' => 'Catalog deleted successfully']);
        return redirect()->route('catalogs.index');
    }
}