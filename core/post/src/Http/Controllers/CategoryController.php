<?php
namespace Hydrogen\Post\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Post\Repositories\Eloquent\CategoryContentRepository;
use Hydrogen\Post\Repositories\Eloquent\CategoryRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $categoryContentRepository;
    protected $seoRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                CategoryContentRepository $categoryContentRepository,
                                SeoRepository $seoRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryContentRepository = $categoryContentRepository;
        $this->seoRepository = $seoRepository;
    }

    public function index() {

        hydrogen_authorize('categories-index');


        $categories = $this->categoryRepository->scopeQuery(function ($query){
            return $query->orderBy('created_at', 'desc');
        })->paginate(20);

        return view('post::category.index', ['categories' => $categories]);

    }

    public function create() {
        hydrogen_authorize('categories-create');

        $categories = $this->categoryRepository->all();

        return view('post::category.create', ['categories' => $categories]);

    }

    public function store(Request $request) {
        hydrogen_authorize('categories-create');

        $category_params = [
            'parent_id' => $request->parent,
        ];

        $category = $this->categoryRepository->create($category_params);

        $categoryContent_params = [
            'slug' => $request->slug,
            'lang_code' => get_default_lang_code(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'cat_id' => $category->id
        ];

        $this->categoryContentRepository->create($categoryContent_params);

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => get_default_lang_code(),
            'owner_type' => 'category',
            'owner_id' => $category->id,
        ];

        $this->seoRepository->create($seo_params);


        Session::flash('flash', ['success' => 'Category created successfully']);
        return redirect()->route('categories.index');
    }

    public function show($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        $category = $this->categoryRepository->find($id);

        return view('post::category.show', ['category' => $category, 'lang_code' => $lang_code]);

    }


    public function trans($id, $lang_code)
    {

        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('categories-create');

        $category = $this->categoryRepository->find($id);

        return view('post::category.trans', [
            'category' => $category,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('categories-create');

        $categoryContent_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'lang_code' => $request->lang_code,
            'cat_id' => $id,
        ];

        $this->categoryContentRepository->create($categoryContent_param);

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => $request->lang_code,
            'owner_type' => 'category',
            'owner_id' => $id,
        ];

        $this->seoRepository->create($seo_params);

        Session::flash('flash', ['success' => 'Category created successfully']);
        return redirect()->route('categories.index');

    }


    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('categories-edit');

        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->findWhere([
            ['id', '!=', $id]
        ]);;

        return view('post::category.edit', [
            'category' => $category,
            'categories' => $categories,
            'lang_code' => $lang_code,
        ]);


    }

    public function update(Request $request, $id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('categories-edit');

        $category = $this->categoryRepository->find($id);

        if($request->parent)
        {
            $this->categoryRepository->update(['parent_id' => $request->parent], $id);
        }

        $categoryContent_params = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
        ];

        $this->categoryContentRepository->update($categoryContent_params, $category->translate($lang_code)->id);

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
        ];

        $this->seoRepository->update($seo_params, $category->seos($lang_code)->id);


        Session::flash('flash', ['success' => 'Category updated successfully']);
        return redirect()->route('categories.index');


    }

    public function destroy(Request $request, $id)
    {
        hydrogen_authorize('categories-destroy');

        $category = $this->categoryRepository->find($id);

        if($request->lang_code)
        {
            $this->categoryContentRepository->delete($category->translate($request->lang_code)->id);
            $this->seoRepository->delete($category->seos($request->lang_code)->id);
        }
        else
        {
            $this->categoryContentRepository->deleteWhere(['cat_id' => $category->id]);
            $this->seoRepository->deleteWhere(['owner_type' => 'category', 'owner_id' => $category->id]);
            $this->categoryRepository->delete($id);

        }
        Session::flash('flash', ['success' => 'Category deleted successfully']);
        return redirect()->route('categories.index');
    }

}