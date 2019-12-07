<?php

use Illuminate\Support\Facades\Config;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use Hydrogen\Post\Models\Category;
use Hydrogen\Product\Models\Catalog\Catalog;

if (!function_exists('reverse_slug')) {
    function reverse_slug($str) {
        $str = str_replace('_', ' ', $str);
        return title_case($str);
    }
}

if (!function_exists('get_lang_code_supported')) {
    function get_lang_code_supported() {
        $result = [];
        foreach(LaravelLocalization::getSupportedLocales() as $key => $value) {
            $result[$key] = $value['name'];
        }
        return $result;
    }
}

if (!function_exists('get_lang_need_translate')) {
    function get_lang_need_translate() {
        $result = [];
        foreach(LaravelLocalization::getSupportedLocales() as $key => $value) {
            if ($key !== get_default_lang_code()) {
                $result[$key] = $value['name'];
            }
        }
        return $result;
    }
}

if (!function_exists('get_lang_name')) {
    function get_lang_name($lang_code) {
        return LaravelLocalization::getSupportedLocales()[$lang_code]['name'];
    }
}

if (!function_exists('get_default_lang_code')) {
    function get_default_lang_code() {
        return Config::get('app.default_locale');
    }
}

if (!function_exists('get_current_lang_code')) {
    function get_current_lang_code() {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('get_templates')) {
    function get_templates($type)
    {
        $templates = ['index' => 'Default'];

        switch ($type)
        {
            case 'page':
                $template_file = File::glob(__THEME_DIR__ . '/page-*.php');
                foreach ($template_file as $fp) {
                    $fn = File::name($fp);
                    $tpl = str_replace('.blade', '', $fn);

                    $name = str_replace('page-', '', $tpl);
                    $name = str_replace('-', '_', $name);
                    $name = reverse_slug($name);
                    $templates[$tpl] = $name;
                }
                return $templates;
            case 'post':
                $templates = ['index' => 'Default'];

                $template_file = File::glob(__THEME_DIR__ . '/post-*.php');
                foreach ($template_file as $fp) {
                    $fn = File::name($fp);
                    $tpl = str_replace('.blade', '', $fn);

                    $name = str_replace('post-', '', $tpl);
                    $name = str_replace('-', '_', $name);
                    $name = reverse_slug($name);
                    $templates[$tpl] = $name;
                }
                return $templates;
            case 'product':
                $templates = ['index' => 'Default'];

                $template_file = File::glob(__THEME_DIR__ . '/product-*.php');
                foreach ($template_file as $fp) {
                    $fn = File::name($fp);
                    $tpl = str_replace('.blade', '', $fn);

                    $name = str_replace('product-', '', $tpl);
                    $name = str_replace('-', '_', $name);
                    $name = reverse_slug($name);
                    $templates[$tpl] = $name;
                }
                return $templates;
        }

    }
}

if (!function_exists('get_template_name')) {
    function get_template_name($template, $type)
    {
        $templates = get_templates($type);
        return $templates[$template];
    }
}

if (!function_exists('render_simple_cat')){
    function render_simple_cat($cat, $lv = 0, $post = null)
    {
        $html = '';
        $str = str_repeat('-----', $lv);


        if($cat->children->isNotEmpty())
        {
            $html .= '<div class="cat-item">
                       <label class="m-checkbox m-checkbox--state-brand">
                               '.$str.' <input type="checkbox" onclick="showChooseCate('.$cat->id.')" name="categories[]" id="cate-btmain-'.$cat->id.'"
                               value="'.$cat->id.'"';

            if($post != null && $post->inCat($cat->id))
            {
                $html .= ' checked';
            }

            $html .=  '>'.$cat->translate(get_default_lang_code())->the_title().'<span></span>
                       </label>
                       <span id="status-'.$cat->id.'">';

            if($post != null && $post->main_cat == $cat->id)
            {
                $html .= '(main)';
            }
            elseif ($post != null && $post->inCat($cat->id) && $post->main_cat != $cat->id)
            {
                $html .= '<a href="javascript:void(0)" id="btmain-'.$cat->id.'" onclick="setMainCate('.$cat->id.')">set to main</a>';
            }

            $html .=  '</span>
                       <div class="cat-item-child">';

            foreach ($cat->children as $child)
            {
                if($post != null)
                {
                    $html .= render_simple_cat($child, $lv + 1, $post);
                }
                else
                {
                    $html .= render_simple_cat($child, $lv + 1);
                }
            }

            $html .=      '</div>
                 </div>';
        }
        else
        {
            $html .= '<div class="cat-item">
                        <label class="m-checkbox m-checkbox--state-brand">
                            '.$str.' <input type="checkbox" onclick="showChooseCate('.$cat->id.')" name="categories[]" id="cate-btmain-'.$cat->id.'"
                               value="'.$cat->id.'"';

            if($post != null && $post->inCat($cat->id))
            {
                $html .= ' checked';
            }

            $html .= '>'.$cat->translate(get_default_lang_code())->the_title().'<span></span>
                        </label>
                        <span id="status-'.$cat->id.'">';

            if($post != null && $post->main_cat == $cat->id)
            {
                $html .= '(main)';
            }
            elseif ($post != null && $post->inCat($cat->id) && $post->main_cat != $cat->id)
            {
                $html .= '<a href="javascript:void(0)" id="btmain-'.$cat->id.'" onclick="setMainCate('.$cat->id.')">set to main</a>';
            }

            $html .=    '</span>
                     </div>';
        }


        return $html;
    }
}


if (!function_exists('render_cat')){
    function render_cat($type, $items = null)
    {
        $html = '';

        if($type == 'category')
        {
            $cat = Category::where('parent_id', 0)->get();
        }
        elseif ($type == 'catalog')
        {
            $cat = Catalog::where('parent_id', 0)->get();
        }

        if($items == null)
        {
            if($cat->isNotEmpty())
            {
                foreach ($cat as $item)
                {
                    $html .= render_simple_cat($item);
                }
            }

        }
        else
        {
            if ($cat->isNotEmpty())
            {
                foreach ($cat as $item) {
                    $html .= render_simple_cat($item, 0,  $items);
                }
            }
        }

        echo $html;

    }
}

if (!function_exists('get_n_words_from_string')) {
    function get_n_words_from_string($string, $n) {
        $words = explode(' ', $string);
        $output = array_slice($words, 0, $n);
        $result = implode(' ', $output);
        return $result;
    }
}
