<?php

use Hydrogen\Seo\Models\SeoUpdate;
use Hydrogen\Widget\Models\Widget;
use Hydrogen\Slider\Models\Slider;
use Hydrogen\Product\Models\Product\Features;
use Hydrogen\Product\Models\Catalog\Catalog;
use Hydrogen\Post\Models\Category;
use Hydrogen\Product\Models\Product\Product;
use Hydrogen\Post\Models\Post;


if (!function_exists('get_seo_overwrite')) {
    function get_seo_overwrite() {
        $url = url()->current();

        $seo_overwrite = SeoUpdate::where('url', $url)->get();

        if($seo_overwrite->isNotEmpty())
        {
            return $seo_overwrite->first();
        }

        return false;
    }
}

if (!function_exists('get_widget'))
{
    function get_widget($position)
    {
        $html = '';

        $widget = Widget::where('positions', $position)->first();

        if($widget != null && $widget->translate(get_current_lang_code()) != null)
        {
            $data = json_decode($widget->translate(get_current_lang_code())->content);

            $col = 12/sizeof($data);

            foreach ($data as $item)
            {
                $html .=   '<div class="col-md-'.$col.' col-sm-6 pre-footer-col">
                                <h2>'.$item->label.'</h2> 
                                <div class="widget_content">
                                    '.$item->content.'
                                </div>
                            </div>';
            }
        }

        return $html;
    }
}


if (!function_exists('render_slider')) {
    function render_slider($position)
    {
        $slider = Slider::where('position', $position)->first();

        if($slider != null)
        {
            return $slider->slides;
        }

        return false;
    }
}


if (!function_exists('get_features_product')) {
    function get_features_product($num = 4)
    {

        $features = Features::orderBy('created_at', 'desc')->get();

        $products = [];

        if($features->isNotEmpty())
        {
            foreach ($features as $feature)
            {
                if($feature->product != null && $feature->product->translate(get_current_lang_code()) != null && $feature->product->translate(get_current_lang_code())->the_status() == true)
                {
                    $products[] = $feature->product;
                }

                if(sizeof($products) == $num)
                {
                    break;
                }
            }

            return $products;
        }

        return false;
    }
}


if (!function_exists('get_catalog_product')) {
    function get_catalog_product($catalog ,$num = 4)
    {

        $catalog = Catalog::where('id', $catalog)->first();
        $products_get = [];

        if($catalog != null)
        {
            $products = $catalog->products()->take(3*$num)->get();

            foreach ($products as $product)
            {
                if($product->translate(get_current_lang_code()) != null && $product->translate(get_current_lang_code())->the_status() == true)
                {
                    $products_get[] = $product;
                }

                if(sizeof($products_get) == $num)
                {
                    break;
                }
            }

            return $products_get;
        }


        return false;
    }
}

if (!function_exists('get_catalog_name')) {
    function get_catalog_name($catalog)
    {

        $catalog = Catalog::where('id', $catalog)->first();

        if($catalog != null)
        {
            if($catalog->translate(get_current_lang_code()) != null)
            {
                return $catalog->translate(get_current_lang_code())->the_title();
            }
            else
            {
                return $catalog->translate(get_default_lang_code())->the_title();
            }

        }


        return false;
    }
}


if (!function_exists('get_category_post')) {
    function get_category_post($category ,$num = 4)
    {

        $category = Category::where('id', $category)->first();
        $posts_get = [];

        if($category != null)
        {
            $posts = $category->posts()->take(3*$num)->get();

            foreach ($posts as $post)
            {
                if($post->translate(get_current_lang_code()) != null && $post->translate(get_current_lang_code())->status == true)
                {
                    $posts_get[] = $post;
                }
            }


            return $posts_get;
        }


        return false;
    }
}

if (!function_exists('get_category_name')) {
    function get_category_name($category)
    {

        $category = Category::where('id', $category)->first();

        if($category != null)
        {
            if($category->translate(get_current_lang_code()) != null)
            {
                return $category->translate(get_current_lang_code())->the_title();
            }
            else
            {
                return $category->translate(get_default_lang_code())->the_title();
            }

        }


        return false;
    }
}


if (!function_exists('get_related_post')) {
    function get_related_post($post)
    {

        $category = Category::where('id', $post->main_cat)->first();
        $get_post = [];

        if($category != null)
        {
            $posts = $category->posts()->take(12)->get();

            foreach ($posts as $post)
            {
                if($post->translate(get_current_lang_code()) != null && $post->translate(get_current_lang_code())->status == true)
                {
                    $get_post[] = $post;
                }

                if(sizeof($get_post) == 4)
                {
                    break;
                }
            }

            return $get_post;
        }


        return false;
    }
}

if (!function_exists('get_related_product')) {
    function get_related_product($product)
    {

        $catalog = Catalog::where('id', $product->main_cat)->first();
        $get_product = [];

        if($catalog != null)
        {
            $products = $catalog->products()->take(12)->get();

            foreach ($products as $product)
            {
                if($product->translate(get_current_lang_code()) != null && $product->translate(get_current_lang_code())->status == true)
                {
                    $get_product[] = $product;
                }

                if(sizeof($get_product) == 4)
                {
                    break;
                }
            }

            return $get_product;
        }


        return false;
    }
}

if (!function_exists('get_newest_product')) {
    function get_newest_product()
    {
        $products = Product::orderBy('created_at', 'desc')->take(12)->get();
        $get_product = [];

        foreach ($products as $product)
        {
            if($product->translate(get_current_lang_code()) != null && $product->translate(get_current_lang_code())->status == true)
            {
                $get_product[] = $product;
            }

            if(sizeof($get_product) == 4)
            {
                break;
            }
        }

        return $get_product;
    }
}

if (!function_exists('get_newest_post')) {
    function get_newest_post()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(12)->get();
        $get_post = [];

        foreach ($posts as $post)
        {
            if($post->translate(get_current_lang_code()) != null && $post->translate(get_current_lang_code())->status == true)
            {
                $get_post[] = $post;
            }

            if(sizeof($get_post) == 4)
            {
                break;
            }
        }

        return $get_post;
    }
}

