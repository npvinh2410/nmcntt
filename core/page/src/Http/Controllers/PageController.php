<?php
namespace Hydrogen\Page\Http\Controllers;

use App\Http\Controllers\Controller;
use Hydrogen\Page\Notifications\NewPageNotification;
use Carbon\Carbon;
use Hydrogen\Base\Repositories\Eloquent\User\UserRepository;
use Hydrogen\Page\Repositories\Eloquent\PageContentRepository;
use Hydrogen\Page\Repositories\Eloquent\PageRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller {

    protected $pageRepository;
    protected $pageContentRepository;
    protected $seoRepository;
    protected $userRepository;

    public function __construct(PageRepository $pageRepository,
                                PageContentRepository $pageContentRepository,
                                SEORepository $seoRepository,
                                UserRepository $userRepository){
        $this->pageRepository = $pageRepository;
        $this->pageContentRepository = $pageContentRepository;
        $this->seoRepository = $seoRepository;
        $this->userRepository = $userRepository;
    }

    public function index() {
        hydrogen_authorize('pages-index');

        $pages = $this->pageRepository->scopeQuery(function ($query){
            return $query->orderBy('created_at', 'desc');
        })->paginate(20);

        return view('page::page.index', ['pages' => $pages]);
    }

    public function create() {
        hydrogen_authorize('pages-create');

        return view('page::page.create');
    }

    public function store(Request $request) {
        hydrogen_authorize('pages-create');

        $status = false;

        if ($request->status)
        {
            $status = true;
        }

        $page_params = [
            'template' => $request->template,
        ];

        $page = $this->pageRepository->create($page_params);

        $pageContent_params = [
            'slug' => $request->slug,
            'lang_code' => get_default_lang_code(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->page_content,
            'status' => $status,
            'user_id' => current_user_id(),
            'thumbnail' => $request->thumbnail,
            'page_id' => $page->id
        ];

        $pageContent = $this->pageContentRepository->create($pageContent_params);




//        $seo_params = [
//            'title' => $request->seo_title,
//            'description' => $request->seo_description,
//            'keywords' => $request->seo_keywords,
//            'canonical' => $request->seo_canonical,
//            'lang_code' => get_default_lang_code(),
//            'owner_type' => 'page',
//            'owner_id' => $page->id,
//        ];
//
//        $this->seoRepository->create($seo_params);


//        if($page_check->status == 0)
//        {
//            $users = $this->userRepository->all();
//            $when = Carbon::now()->addMinutes(1);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['pages-publish']))
//                {
//                    $user->notify((new NewPageNotification($page_check))->delay($when));
//                }
//            }
//        }

        Session::flash('flash', ['success' => 'Page created successfully']);
        return redirect()->route('pages.index');
    }

    public function trans($id, $lang_code)
    {

        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('pages-create');

        $page = $this->pageRepository->find($id);

        return view('page::page.trans', [
            'page' => $page,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('pages-create');

        $lang_code = $request->lang_code;
        // trans

        $status = false;
        if ($request->status)
        {
            $status = true;
        }


        $pageContentTranslation_params = [
            'slug' => $request->slug,
            'lang_code' => $lang_code,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->page_content,
            'status' => $status,
            'user_id' => current_user_id(),
            'thumbnail' => $request->thumbnail,
            'page_id' => $id
        ];

        $pageContent = $this->pageContentRepository->create($pageContentTranslation_params);


//        $seo_params = [
//            'title' => $request->seo_title,
//            'description' => $request->seo_description,
//            'keywords' => $request->seo_keywords,
//            'canonical' => $request->seo_canonical,
//            'lang_code' => $lang_code,
//            'owner_type' => 'page',
//            'owner_id' => $id,
//        ];
//
//        $this->seoRepository->create($seo_params);


//        if($page_check->status == 0)
//        {
//            $users = $this->userRepository->all();
//            $when = Carbon::now()->addMinutes(1);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['pages-publish']))
//                {
//                    $user->notify((new NewPageNotification($page_check))->delay($when));
//                }
//            }
//        }

        Session::flash('flash', ['success' => 'Page created successfully']);
        return redirect()->route('pages.index');

    }

    public function show($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        $page = $this->pageRepository->find($id);

        return view('page::page.show', ['page' => $page, 'lang_code' => $lang_code]);

    }


    public function edit($id, $lang_code)
    {

        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('pages-edit');

        $page = $this->pageRepository->find($id);

        return view('page::page.edit', [
            'page' => $page,
            'lang_code' => $lang_code
        ]);
    }

    public function update(Request $request, $id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('pages-edit');

        $page = $this->pageRepository->find($id);

        if($lang_code == get_default_lang_code())
        {
            $page_params = [
                'template' =>  $request->template
            ];

            $this->pageRepository->update($page_params, $page->id);
        }

        $status = false;
        if ($request->status)
        {
            $status = true;
        }

        $pageContent_params = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->page_content,
            'status' => $status,
            'thumbnail' => $request->thumbnail,
        ];

        $this->pageContentRepository->update($pageContent_params, $page->translate($lang_code)->id);

//        $seo_params = [
//            'title' => $request->seo_title,
//            'description' => $request->seo_description,
//            'keywords' => $request->seo_keywords,
//            'canonical' => $request->seo_canonical,
//        ];
//
//        $this->seoRepository->update($seo_params, $page->seos($lang_code)->id);


//        if($page_check->status == 0)
//        {
//            $users = $this->userRepository->all();
//
//            $delay_time_for_safe = 3; // minutes
//
//            $when = Carbon::now()->addMinutes($delay_time_for_safe);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['pages-publish']))
//                {
//                    $user->notify((new NewPageNotification($page_check))->delay($when));
//                }
//            }
//        }

        Session::flash('flash', ['success' => 'Pages updated successfully']);
        return redirect()->route('pages.index');
    }

    public function destroy(Request $request, $id) {
        hydrogen_authorize('pages-destroy');

        $page = $this->pageRepository->find($id);

        if($request->lang_code) {

            $this->pageContentRepository->delete($page->translate($request->lang_code)->id);

//            $this->seoRepository->delete($page->seos($request->lang_code)->id);

        }
        else
        {
            $this->pageContentRepository->deleteWhere(['page_id' => $page->id]);

            $this->pageRepository->delete($id);

//            $this->seoRepository->deleteWhere([
//                'owner_type' => 'page',
//                'owner_id' => $id,
//            ]);

        }
        Session::flash('flash', ['success' => 'Page deleted successfully']);
        return redirect()->route('pages.index');
    }
}