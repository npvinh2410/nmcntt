<?php
namespace Hydrogen\Post\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hydrogen\Base\Repositories\Eloquent\User\UserRepository;
use Hydrogen\Post\Notifications\NewPostNotification;
use Hydrogen\Post\Repositories\Eloquent\CategoryRepository;
use Hydrogen\Post\Repositories\Eloquent\PostContentRepository;
use Hydrogen\Post\Repositories\Eloquent\PostRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller {

    protected $categoryRepository;
    protected $postRepository;
    protected $postContentRepository;
    protected $seoRepository;
    protected $userRepository;

    public function __construct(PostRepository $postRepository,
                                PostContentRepository $postContentRepository,
                                CategoryRepository $categoryRepository,
                                SeoRepository $seoRepository,
                                UserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->postContentRepository = $postContentRepository;
        $this->seoRepository = $seoRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        hydrogen_authorize('posts-index');

        $posts = $this->postRepository->scopeQuery(function ($query){
            return $query->orderBy('created_at', 'desc');
        })->paginate(20);

        return view('post::post.index', ['posts' => $posts]);

    }

    public function create()
    {
        hydrogen_authorize('posts-create');

        $categories = $this->categoryRepository->all();

        return view('post::post.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        hydrogen_authorize('posts-create');

        $categories = $request->categories;

        if($categories == null)
        {
            Session::flash('flash', ['danger' => 'Please Choose Categories For This Post']);
            return redirect()->back()->withInput();
        }

        $status = false;

        if ($request->status)
        {
            $status = true;
        }

        $post_params = [
            'template' => $request->template,
        ];

        if($request->main_cat)
        {
            $post_params['main_cat'] = $request->main_cat;
        }
        else
        {
            $post_params['main_cat'] = $categories[0];
        }


        $post = $this->postRepository->create($post_params);

        $postContent_params = [
            'slug' => $request->slug,
            'lang_code' => get_default_lang_code(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->post_content,
            'status' => $status,
            'user_id' => current_user_id(),
            'thumbnail' => $request->thumbnail,
            'post_id' => $post->id,
        ];

        $this->postContentRepository->create($postContent_params);

        if(is_array($categories)) {
            foreach ($categories as $cat_id) {
                $post->attachCategory($cat_id);
            }
        }

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
            'lang_code' => get_default_lang_code(),
            'owner_type' => 'post',
            'owner_id' => $post->id,
        ];

        $this->seoRepository->create($seo_params);

//        if($post_check->status == 0)
//        {
//
//            $users = $this->userRepository->all();
//            $when = Carbon::now()->addMinutes(1);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['posts-publish']))
//                {
//                    $user->notify((new NewPostNotification($post_check))->delay($when));
//                }
//            }
//        }

        Session::flash('flash', ['success' => 'Posts created successfully']);
        return redirect()->route('posts.index');
    }

    public function show($id, $lang_code)
    {

        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        $post = $this->postRepository->find($id);

        return view('post::post.show', [
            'post' => $post,
            'lang_code' => $lang_code,
        ]);
    }


    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort('404');
        }

        hydrogen_authorize('posts-create');

        $post = $this->postRepository->find($id);

        return view('post::post.trans', [
            'post' => $post,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        hydrogen_authorize('posts-create');

        if(get_setting('multi_lang') != 'on')
        {
            abort('404');
        }

        $status = false;

        if ($request->status)
        {
            $status = true;
        }

        $postContent_params = [
            'slug' => $request->slug,
            'lang_code' => $request->lang_code,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->post_content,
            'status' => $status,
            'user_id' => current_user_id(),
            'thumbnail' => $request->thumbnail,
            'post_id' => $id,
        ];



        $this->postContentRepository->create($postContent_params);

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
            'lang_code' => $request->lang_code,
            'owner_type' => 'post',
            'owner_id' => $id,
        ];

        $this->seoRepository->create($seo_params);

//        if($post_check->status == 0)
//        {
//
//            $users = $this->userRepository->all();
//            $when = Carbon::now()->addMinutes(1);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['posts-publish']))
//                {
//                    $user->notify((new NewPostNotification($post_check))->delay($when));
//                }
//            }
//        }

        Session::flash('flash', ['success' => 'Post created successfully']);
        return redirect()->route('posts.index');

    }

    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('posts-edit');

        $post = $this->postRepository->find($id);
        $categories = $this->categoryRepository->all();

        return view('post::post.edit', [
                'post' => $post,
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

        hydrogen_authorize('posts-edit');

        if(!$request->categories && $lang_code == get_default_lang_code())
        {
            Session::flash('flash', ['danger' => 'Please Choose Categories For This Post']);
            return redirect()->back()->withInput();
        }

        $post = $this->postRepository->find($id);

        $status = false;

        if ($request->status)
        {
            $status = true;
        }

        if($lang_code == get_default_lang_code())
        {
            $post_params = [
                'main_cat' => $request->main_cat,
                'template' => $request->template
            ];

            $this->postRepository->update($post_params, $post->id);
        }



        $postContent_params = [
            'slug' => $request->slug,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->post_content,
            'status' => $status,
            'thumbnail' => $request->thumbnail,
        ];

        $this->postContentRepository->update($postContent_params, $post->translate($lang_code)->id);

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
        ];

        $this->seoRepository->update($seo_params, $post->seos($lang_code)->id);

        // update categories

        if(is_array($request->categories)) {
            $post->detachCateogories();

            foreach($request->categories as $cat) {
                $post->attachCategory($cat);
            }
        }




//        if($post_check->status == 0)
//        {
//
//            $users = $this->userRepository->all();
//            $when = Carbon::now()->addMinutes(1);
//
//            foreach ($users as $user)
//            {
//                if($user->can(['posts-publish']))
//                {
//                    $user->notify((new NewPostNotification($post_check))->delay($when));
//                }
//            }
//        }



        Session::flash('flash', ['success' => 'Posts updated successfully']);
        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, $id) {
        hydrogen_authorize('posts-destroy');

        $post = $this->postRepository->find($id);

        if($request->lang_code)
        {
            $this->postContentRepository->delete($post->translate($request->lang_code)->id);
            $this->seoRepository->delete($post->seos($request->lang_code)->id);
        }
        else
        {
            $post->detachCateogories();
            $this->postContentRepository->deleteWhere(['post_id' => $post->id]);
            $this->seoRepository->deleteWhere(['owner_type' => 'post', 'owner_id' => $post->id]);
            $this->postRepository->delete($id);

        }
        Session::flash('flash', ['success' => 'Post deleted successfully']);
        return redirect()->route('posts.index');
    }



}