<?php

namespace Hydrogen\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Product\Repositories\Eloquent\Catalog\TagRepository;
use Hydrogen\Product\Repositories\Eloquent\Catalog\TagTransRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    protected $tagRepository;
    protected $tagTransRepository;
    protected $seoRepository;

    public function __construct(TagRepository $tagRepository,
                                TagTransRepository $tagTransRepository,
                                SeoRepository $seoRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->tagTransRepository = $tagTransRepository;
        $this->seoRepository = $seoRepository;
    }

    public function index()
    {
        hydrogen_authorize('catalogs-index');

        $tags = $this->tagRepository->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->paginate(20);

        return view('product::tag.index', ['tags' => $tags]);
    }

    public function create()
    {
        hydrogen_authorize('catalogs-create');

        $tags = $this->tagRepository->all();

        return view('product::tag.create', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        hydrogen_authorize('catalogs-create');

        $tag_param = [];

        $tag = $this->tagRepository->create($tag_param);

        $tagTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'lang_code' => get_default_lang_code(),
            'tag_id' => $tag->id,
        ];

        $this->tagTransRepository->create($tagTrans_param);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => get_default_lang_code(),
            'owner_type' => 'tag',
            'owner_id' => $tag->id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Tag created successfully']);
        return redirect()->route('tags.index');

    }

    public function show($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-show');

        $tag = $this->tagRepository->find($id);

        return view('product::tag.show', ['tag' => $tag, 'lang_code' => $lang_code]);
    }

    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-create');

        $tag = $this->tagRepository->find($id);

        return view('product::tag.trans', [
            'tag' => $tag,
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

        $tagTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'lang_code' => $request->lang_code,
            'tag_id' => $id,
        ];

        $this->tagTransRepository->create($tagTrans_param);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'lang_code' => $request->lang_code,
            'owner_type' => 'tag',
            'owner_id' => $id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Tag created successfully']);
        return redirect()->route('tags.index');
    }

    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('catalogs-edit');

        $tag = $this->tagRepository->find($id);

        return view('product::tag.edit', [
            'tag' => $tag,
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

        $tag = $this->tagRepository->find($id);


        $tagTrans_param = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
        ];

        $this->tagTransRepository->update($tagTrans_param, $tag->translate($lang_code)->id);

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
        ];

        $this->seoRepository->update($seo_param, $tag->seos($lang_code)->id);


        Session::flash('flash', ['success' => 'Tag updated successfully']);
        return redirect()->route('tags.index');
    }

    public function destroy(Request $request, $id) {
        hydrogen_authorize('catalogs-destroy');

        $tag = $this->tagRepository->find($id);

        if($request->lang_code)
        {
            $this->seoRepository->delete($tag->seos($request->lang_code)->id);
            $this->tagTransRepository->delete($tag->translate($request->lang_code)->id);
        }
        else
        {
            $this->seoRepository->deleteWhere(['owner_type' => 'tag', 'owner_id' => $id]);
            $this->tagTransRepository->deleteWhere(['tag_id' => $id]);
            $this->tagRepository->delete($id);
        }
        Session::flash('flash', ['success' => 'Tag deleted successfully']);
        return redirect()->route('tags.index');
    }
}