<?php

namespace Hydrogen\Theme\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Page\Repositories\Eloquent\PageContentRepository;
use Hydrogen\Post\Repositories\Eloquent\CategoryContentRepository;
use Hydrogen\Post\Repositories\Eloquent\PostContentRepository;
use Hydrogen\Product\Repositories\Eloquent\Catalog\CatalogTransRepository;
use Hydrogen\Product\Repositories\Eloquent\Product\ProductTransRepository;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    protected $pageContentRepository;
    protected $catalogTransRepository;
    protected $categoryContentRepository;
    protected $postContentRepository;
    protected $productTransRepository;

    public function __construct(PageContentRepository $pageContentRepository
//                                CatalogTransRepository $catalogTransRepository,
//                                CategoryContentRepository $categoryContentRepository,
//                                PostContentRepository $postContentRepository,
//                                ProductTransRepository $productTransRepository
    )
    {
//        $this->productTransRepository = $productTransRepository;
//        $this->catalogTransRepository = $catalogTransRepository;
//        $this->categoryContentRepository = $categoryContentRepository;
//        $this->postContentRepository = $postContentRepository;
//        $this->productTransRepository = $productTransRepository;
        $this->pageContentRepository = $pageContentRepository;
    }

    public function home()
    {

        return view('theme::index');
    }



    public function show_view($slug)
    {
        if($slug == 'bien-ban-thanh-lap-nhom')
        {
            return view('theme::bbtln');
        }
        else
        {
            $pageContent = $this->pageContentRepository->findByField('slug', $slug);


            if($pageContent->isNotEmpty())
            {
                $check = $this->pageContentRepository->findWhere(['slug' => $slug, 'lang_code' => get_current_lang_code()]);

                if($check->isNotEmpty())
                {
                    return view('theme::' . $pageContent->first()->page->template, ['page' => $pageContent->first()->page]);
                }
                else
                {
                    if($pageContent->first()->page->translate(get_current_lang_code()) != null)
                    {
                        return redirect()->route('view', ['slug' => $pageContent->first()->page->translate(get_current_lang_code())->the_hyperlink()]);
                    }
                }
            }
        }

        //        $categoryContent = $this->categoryContentRepository->findByField('slug', $slug);
//        $catalogContent = $this->catalogTransRepository->findByField('slug', $slug);
//        $postContent = $this->postContentRepository->findByField('slug', $slug);
//        $productContent = $this->productTransRepository->findByField('slug', $slug);
//        elseif($categoryContent->isNotEmpty())
//        {
//            $check = $this->categoryContentRepository->findWhere(['slug' => $slug, 'lang_code' => get_current_lang_code()]);
//
//            if($check->isNotEmpty())
//            {
//                return view('theme::catalog', ['obj' => $categoryContent->first()->category]);
//            }
//            else
//            {
//                if($categoryContent->first()->category->translate(get_current_lang_code()) != null)
//                {
//                    return redirect()->route('view', ['slug' => $categoryContent->first()->category->translate(get_current_lang_code())->the_hyperlink()]);
//                }
//            }
//        }
//        elseif ($catalogContent->isNotEmpty())
//        {
//            $check = $this->catalogTransRepository->findWhere(['slug' => $slug, 'lang_code' => get_current_lang_code()]);
//
//            if($check->isNotEmpty())
//            {
//                return view('theme::catalog', ['obj' => $catalogContent->first()->catalog]);
//            }
//            else
//            {
//                if($catalogContent->first()->catalog->translate(get_current_lang_code()) != null)
//                {
//                    return redirect()->route('view', ['slug' => $catalogContent->first()->catalog->translate(get_current_lang_code())->the_hyperlink()]);
//                }
//            }
//        }
//        elseif($postContent->isNotEmpty())
//        {
//            $check = $this->postContentRepository->findWhere(['slug' => $slug, 'lang_code' => get_current_lang_code()]);
//
//            if($check->isNotEmpty())
//            {
//                return view('theme::'. $postContent->first()->post->template, ['post' => $postContent->first()->post]);
//            }
//            else
//            {
//                if($postContent->first()->post->translate(get_current_lang_code()) != null)
//                {
//                    return redirect()->route('view', ['slug' => $postContent->first()->post->translate(get_current_lang_code())->the_hyperlink()]);
//                }
//            }
//        }
//        elseif($productContent->isNotEmpty())
//        {
//            $check = $this->productTransRepository->findWhere(['slug' => $slug, 'lang_code' => get_current_lang_code()]);
//
//            if($check->isNotEmpty())
//            {
//                return view('theme::'. $productContent->first()->product->template, ['product' => $productContent->first()->product]);
//            }
//            else
//            {
//                if($productContent->first()->product->translate(get_current_lang_code()) != null)
//                {
//                    return redirect()->route('view', ['slug' => $productContent->first()->product->translate(get_current_lang_code())->the_hyperlink()]);
//                }
//            }
//        }

        abort(404);
    }


}