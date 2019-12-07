<?php
use Illuminate\Support\Facades\DB;
use Hydrogen\Menu\Models\Menu;
use Hydrogen\Page\Models\Page;
use Hydrogen\Post\Models\Category;
use Hydrogen\Product\Models\Catalog\Catalog;


if (!function_exists('get_free_position')) {
    function get_free_position($type)
    {
        $free_position = [];

        switch ($type)
        {
            case 'slider':
                $positions = config('slider.positions');
                $free_position = [];
                foreach ($positions as $position) {

                    $menu = DB::table('sliders')->where('position', $position)->first();

                    if(!$menu) {
                        $free_position[] = $position;
                    }

                }
                break;
            case 'menu':
                $positions = config('menu.positions');
                $free_position = [];
                foreach ($positions as $position) {

                    $menu = DB::table('menus')->where('position', $position)->first();

                    if(!$menu) {
                        $free_position[] = $position;
                    }

                }
                break;
            case 'widget':
                $positions = config('widget.positions');
                $free_position = [];
                foreach ($positions as $position) {

                    $menu = DB::table('widgets')->where('positions', $position)->first();

                    if(!$menu) {
                        $free_position[] = $position;
                    }

                }
                break;
        }

        return $free_position;
    }
}

if (!function_exists('render_show_menu')) {
    function render_show_menu($data)
    {
        $menu = json_decode($data);
        $html = '<ul>';

        foreach ($menu as $item)
        {
            if (isset($item->children))
            {
                $html .= '<li>'.$item->label;
                $html .= '<ul>';

                foreach($item->children as $child_1)
                {
                    if (isset($child_1->children))
                    {
                        $html .= '<li>'.$child_1->label;
                        $html .= '<ul>';

                        foreach($child_1->children as $child_2)
                        {
                            if (isset($child_2->children))
                            {
                                $html .= '<li>'.$child_2->label;
                                $html .= '<ul>';

                                foreach($child_2->children as $child_3)
                                {
                                    $html .= '<li>'.$child_3->label.'</li>';
                                }

                                $html .= '</ul>';
                                $html .= '</li>';
                            }
                            else
                            {
                                $html .= '<li>'.$child_2->label.'</li>';
                            }
                        }

                        $html .= '</ul>';
                        $html .= '</li>';
                    }
                    else
                    {
                        $html .= '<li>'.$child_1->label.'</li>';
                    }
                }

                $html .= '</ul>';
                $html .= '</li>';
            }
            else
            {
                $html .= '<li>'.$item->label.'</li>';
            }
        }

        $html .='</ul>';

        return $html;
    }
}

//edit menu

if (!function_exists('nestable_simple_render_menu_item')) {
    function nestable_simple_render_menu_item($item)
    {
        $html = '';

        switch ($item->type) {
            case 'custom_link':
                $html .= '<li class="dd-item" id="item-'.$item->id.'" data-id="'.$item->id.'" data-type="custom_link" data-label="'.$item->label.'" data-url="'.$item->url.'" data-target="'.$item->target.'" data-follow="'.$item->follow.'">';
                $html .= '<div class="dd-handle">'.$item->label.'</div>';
                $html .= '<div class="dd-actions">';
                $html .= '<a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_link" data-id="'.$item->id.'">';
                $html .= '<i class="fa fa-pencil-square"></i>';
                $html .= '</a>';
                $html .= '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('.$item->id.')">';
                $html .= '<i class="fa fa-trash"></i>';
                $html .= '</a>';
                $html .= '</div>';

                break;
            case 'page':
                $html .= '<li class="dd-item" id="item-'.$item->id.'" data-id="'.$item->id.'" data-type="page" data-pid="'.$item->pid.'" data-label="'.$item->label.'">';
                $html .= '<div class="dd-handle">'.$item->label.'</div>';
                $html .= '<div class="dd-actions">';
                $html .= '<a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_page" data-id="'.$item->id.'">';
                $html .= '<i class="fa fa-pencil-square"></i>';
                $html .= '</a>';
                $html .= '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('.$item->id.')">';
                $html .= '<i class="fa fa-trash"></i>';
                $html .= '</a>';
                $html .= '</div>';

                break;
            case 'category':
                $html .= '<li class="dd-item" id="item-'.$item->id.'" data-id="'.$item->id.'" data-type="category" data-label="'.$item->label.'" data-cid="'.$item->cid.'">';
                $html .= '<div class="dd-handle">'.$item->label.'</div>';
                $html .= '<div class="dd-actions">';
                $html .= '<a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_category" data-id="'.$item->id.'">';
                $html .= '<i class="fa fa-pencil-square"></i>';
                $html .= '</a>';
                $html .= '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('.$item->id.')">';
                $html .= '<i class="fa fa-trash"></i>';
                $html .= '</a>';
                $html .= '</div>';

                break;
            case 'catalog':
                $html .= '<li class="dd-item" id="item-'.$item->id.'" data-id="'.$item->id.'" data-type="catalog" data-label="'.$item->label.'" data-pcid="'.$item->pcid.'">';
                $html .= '<div class="dd-handle">'.$item->label.'</div>';
                $html .= '<div class="dd-actions">';
                $html .= '<a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_catalog" data-id="'.$item->id.'">';
                $html .= '<i class="fa fa-pencil-square"></i>';
                $html .= '</a>';
                $html .= '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('.$item->id.')">';
                $html .= '<i class="fa fa-trash"></i>';
                $html .= '</a>';
                $html .= '</div>';

                break;
        }

        return $html;
    }
}


if (!function_exists('nestable_render_menu')) {
    function nestable_render_menu($data)
    {
        $menu = json_decode($data);
        $html = '';

        foreach ($menu as $item)
        {
            if (isset($item->children))
            {
                $html .= nestable_simple_render_menu_item($item);
                $html .= '<ol class="dd-list">';

                foreach($item->children as $child_1)
                {
                    if (isset($child_1->children))
                    {
                        $html .= nestable_simple_render_menu_item($child_1);
                        $html .= '<ol class="dd-list">';

                        foreach($child_1->children as $child_2)
                        {
                            if (isset($child_2->children))
                            {
                                $html .= nestable_simple_render_menu_item($child_2);
                                $html .= '<ol class="dd-list">';

                                foreach($child_2->children as $child_3)
                                {
                                    $html .= nestable_simple_render_menu_item($child_3).'</li>';
                                }

                                $html .= '</ol>';
                                $html .= '</li>';
                            }
                            else
                            {
                                $html .= nestable_simple_render_menu_item($child_2).'</li>';
                            }
                        }

                        $html .= '</ol>';
                        $html .= '</li>';
                    }
                    else
                    {
                        $html .= nestable_simple_render_menu_item($child_1).'</li>';
                    }
                }

                $html .= '</ol>';
                $html .= '</li>';
            }
            else
            {
                $html .= nestable_simple_render_menu_item($item).'</li>';
            }
        }

        return $html;
    }
}

//edit menu

if (!function_exists('nestable_simple_render_widget_item')) {
    function nestable_simple_render_widget_item($item)
    {

        $html = '<li class="dd-item" id="item-'.$item->id.'" data-id="'.$item->id.'" data-label="'.$item->label.'" data-content="'.$item->content.'">
                    <div class="dd-handle">'.$item->label.'</div>
                    <div class="dd-actions">
                        <a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_widget" data-id="'.$item->id.'">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                        <a class="btn btn-sm btn-danger padding-3" onclick="delete_item('.$item->id.')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </li>';


        return $html;
    }
}


if (!function_exists('nestable_render_widget')) {
    function nestable_render_widget($data)
    {
        $menu = json_decode($data);
        $html = '';

        foreach ($menu as $item)
        {
            if (isset($item->children))
            {
                $html .= nestable_simple_render_widget_item($item);
                $html .= '<ol class="dd-list">';

                foreach($item->children as $child_1)
                {
                    if (isset($child_1->children))
                    {
                        $html .= nestable_simple_render_widget_item($child_1);
                        $html .= '<ol class="dd-list">';

                        foreach($child_1->children as $child_2)
                        {
                            if (isset($child_2->children))
                            {
                                $html .= nestable_simple_render_widget_item($child_2);
                                $html .= '<ol class="dd-list">';

                                foreach($child_2->children as $child_3)
                                {
                                    $html .= nestable_simple_render_widget_item($child_3).'</li>';
                                }

                                $html .= '</ol>';
                                $html .= '</li>';
                            }
                            else
                            {
                                $html .= nestable_simple_render_widget_item($child_2).'</li>';
                            }
                        }

                        $html .= '</ol>';
                        $html .= '</li>';
                    }
                    else
                    {
                        $html .= nestable_simple_render_widget_item($child_1).'</li>';
                    }
                }

                $html .= '</ol>';
                $html .= '</li>';
            }
            else
            {
                $html .= nestable_simple_render_widget_item($item).'</li>';
            }
        }

        return $html;
    }
}

if (!function_exists('render_lv_item'))
{
    function render_lv_item($url, $title, $lv, $child = false, $target = null, $follow = null)
    {
        $html = '';

        switch ($lv) {
            case 0:
                $html .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="'.$url.'"';

                if($target != null)
                {
                    $html .= ' target="'.$target.'" ';
                }

                if($follow != null)
                {
                    $html .= ' rel="'.$follow.'" ';
                }

                $html .= '>'.$title.'</a>';
                break;
            case 1:
                if($child == true)
                {
                    $html .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="'.$url.'"';

                    if($target != null)
                    {
                        $html .= ' target="'.$target.'" ';
                    }

                    if($follow != null)
                    {
                        $html .= ' rel="'.$follow.'" ';
                    }

                    $html .= '>'.$title.' <i class="fa fa-angle-right"></i></a>';
                }
                else
                {
                    $html .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="'.$url.'"';

                    if($target != null)
                    {
                        $html .= ' target="'.$target.'" ';
                    }

                    if($follow != null)
                    {
                        $html .= ' rel="'.$follow.'" ';
                    }

                    $html .= '>'.$title.'</a>';
                }
                break;
            case 2:
                if($child == true)
                {
                    $html .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="'.$url.'"';

                    if($target != null)
                    {
                        $html .= ' target="'.$target.'" ';
                    }

                    if($follow != null)
                    {
                        $html .= ' rel="'.$follow.'" ';
                    }

                    $html .= '>'.$title.' <i class="fa fa-angle-right"></i></a>';
                }
                else
                {
                    $html .= '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="'.$url.'"';

                    if($target != null)
                    {
                        $html .= ' target="'.$target.'" ';
                    }

                    if($follow != null)
                    {
                        $html .= ' rel="'.$follow.'" ';
                    }

                    $html .= '>'.$title.'</a>';
                }
                break;
            case 3:
                $html .= '<a href="'.$url.'"';

                if($target != null)
                {
                    $html .= ' target="'.$target.'" ';
                }

                if($follow != null)
                {
                    $html .= ' rel="'.$follow.'" ';
                }

                $html .= '>'.$title.'</a>';
                break;
        }

        return $html;
    }
}


if (!function_exists('render_menu_item'))
{
    function render_menu_item($item, $lv, $child = false)
    {
        switch ($item->type) {
            case 'page':

                $page = Page::where('id', $item->pid)->first();

                if($page != null && $page->translate(get_current_lang_code()) != null && $page->translate(get_current_lang_code())->the_status())
                {
                    return render_lv_item(route('view', $page->translate(get_current_lang_code())->the_hyperlink()), $page->translate(get_current_lang_code())->the_title(), $lv, $child);
                }
                else
                {
                    $html = false;
                }
                break;
            case 'category':

                $category = Category::where('id', $item->cid)->first();

                if($category != null && $category->translate(get_current_lang_code()) != null)
                {
                    return render_lv_item(route('view', $category->translate(get_current_lang_code())->the_hyperlink()), $category->translate(get_current_lang_code())->the_title(), $lv, $child);
                }
                else
                {
                    $html = false;
                }
                break;
            case 'catalog':

                $catalog = Catalog::where('id', $item->pcid)->first();

                if($catalog != null && $catalog->translate(get_current_lang_code()) != null)
                {
                    return render_lv_item(route('view', $catalog->translate(get_current_lang_code())->the_hyperlink()), $catalog->translate(get_current_lang_code())->the_title(), $lv, $child);
                }
                else
                {
                    $html = false;
                }
                break;
            case 'custom_link':
                $html = render_lv_item($item->url, $item->label, $lv, $child, $item->target, $item->follow);
                break;
        }

        return $html;
    }
}


if (!function_exists('render_3lv_item')) {
    function render_3lv_item($position)
    {

        $html = '';

        $menu = Menu::where('position', $position)->first();

        if($menu != null && $menu->data != null)
        {
            $data = json_decode($menu->data);

            foreach ($data as $child_lv0)
            {
                if(isset($child_lv0->children) && render_menu_item($child_lv0, 0, true) != false)
                {
                    $html .= '<li class="dropdown">';
                    $html .= render_menu_item($child_lv0, 0, true);
                    $html .=    '<ul class="dropdown-menu">';

                        foreach ($child_lv0->children as $child_lv1)
                        {
                            if(isset($child_lv1->children) && render_menu_item($child_lv1, 1, true) != false)
                            {
                                $html .= '<li class="dropdown-submenu">';
                                $html .= render_menu_item($child_lv1, 1, true);
                                $html .=    '<ul class="dropdown-menu" role="menu">';

                                    foreach ($child_lv1->children as $child_lv2)
                                    {
                                        if(isset($child_lv2->children) && render_menu_item($child_lv2, 2, true) != false)
                                        {
                                            $html .= '<li class="dropdown-submenu">';
                                            $html .= render_menu_item($child_lv2, 2, true);
                                            $html .=    '<ul class="dropdown-menu">';

                                            foreach ($child_lv2->children as $child_lv3)
                                            {
                                                if(render_menu_item($child_lv3, 3, false) != false)
                                                {
                                                    $html .= render_menu_item($child_lv3, 3, false);
                                                }
                                            }

                                            $html .=    '</ul>
                                                      </li>';
                                        }
                                        elseif(render_menu_item($child_lv2, 2, true) != false)
                                        {
                                            $html .= '<li>'.render_menu_item($child_lv2, 2, false).'</li>';
                                        }
                                    }

                                $html .=    '</ul>
                                          </li>';
                            }
                            elseif(render_menu_item($child_lv1, 1, true) != false)
                            {
                                $html .= '<li>'.render_menu_item($child_lv1, 1, false).'</li>';
                            }
                        }

                    $html .=    '</ul>
                             </li>';
                }
                elseif (render_menu_item($child_lv0, 0, true) != false)
                {
                    $html .= '<li>'.render_menu_item($child_lv0, 0, false).'</li>';
                }
            }

            return $html;
        }

        return false;
    }
}


if (!function_exists('render_1lv_menu')) {
    function render_1lv_menu($position)
    {
        $menu = Menu::where('position', $position)->first();

        if($menu != null && $menu->data != null)
        {
            $data = json_decode($menu->data);
            $html = '';

            foreach ($data as $item)
            {
                if(render_menu_item($item, 0, false) != false)
                {
                    $html .= '<li>'.render_menu_item($item, 0, false).'</li>';
                }
            }

            echo $html;
        }

        return false;
    }
}



if (!function_exists('render_menu_item_2'))
{
    function render_menu_item_2($item)
    {
        $html = '';

        switch ($item->type) {
            case 'page':

                $page = Page::where('id', $item->pid)->first();

                if($page != null && $page->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $page->translate(get_current_lang_code())->the_hyperlink()).'">
                                <span>'.$page->translate(get_current_lang_code())->the_title().'</span>
                             </a>';
                }
                else
                {
                    $html = false;
                }

                break;
            case 'category':

                $category = Category::where('id', $item->cid)->first();

                if($category != null && $category->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $category->translate(get_current_lang_code())->the_hyperlink()).'">
                                <span>'.$category->translate(get_current_lang_code())->the_title().'</span>
                              </a>';
                }
                else
                {
                    $html = false;
                }
                break;
            case 'catalog':

                $catalog = Catalog::where('id', $item->pcid)->first();

                if($catalog != null && $catalog->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $catalog->translate(get_current_lang_code())->the_hyperlink()).'">
                                    <span>'.$catalog->translate(get_current_lang_code())->the_title().'</span>
                              </a>';
                }
                else
                {
                    $html = false;
                }
                break;
            case 'custom_link':
                $html .= '<a href="'.$item->url.'" target="'.$item->target.'" rel="'.$item->follow.'">
                            <span>'.$item->label.'</span>
                          </a>';
                break;
        }

        return $html;
    }
}

if (!function_exists('render_menu_item_3'))
{
    function render_menu_item_3($item)
    {
        $html = '';

        switch ($item->type) {
            case 'page':

                $page = Page::where('id', $item->pid)->first();

                if($page != null && $page->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $page->translate(get_current_lang_code())->the_hyperlink()).'">
                                <i class="fa fa-angle-right"></i>'.$page->translate(get_current_lang_code())->the_title().'
                             </a>';
                }
                else
                {
                    $html = false;
                }

                break;
            case 'category':

                $category = Category::where('id', $item->cid)->first();

                if($category != null && $category->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $category->translate(get_current_lang_code())->the_hyperlink()).'">
                                <i class="fa fa-angle-right"></i>'.$category->translate(get_current_lang_code())->the_title().'
                              </a>';
                }
                else
                {
                    $html = false;
                }
                break;
            case 'catalog':

                $catalog = Catalog::where('id', $item->pcid)->first();

                if($catalog != null && $catalog->translate(get_current_lang_code()) != null)
                {
                    $html .= '<a href="'.route('view', $catalog->translate(get_current_lang_code())->the_hyperlink()).'">
                                    <i class="fa fa-angle-right"></i>'.$catalog->translate(get_current_lang_code())->the_title().'
                              </a>';
                }
                else
                {
                    $html = false;
                }
                break;
            case 'custom_link':
                $html .= '<a href="'.$item->url.'" target="'.$item->target.'" rel="'.$item->follow.'">
                            <i class="fa fa-angle-right"></i>'.$item->label.'
                          </a>';
                break;
        }

        return $html;
    }
}


if (!function_exists('render_product_menu')) {
    function render_product_menu()
    {
        $menu = Menu::where('position', 'PRODUCT')->first();
        $html = '';

        if($menu != null && $menu->data != null)
        {
            $data = json_decode($menu->data);

            $html .= '<ul class="list-group margin-bottom-25 sidebar-menu">';

            foreach ($data as $child_0)
            {
                if(isset($child_0->children) && render_menu_item_3($child_0) != false)
                {
                    $html .= '<li class="list-group-item clearfix dropdown">';
                    $html .= render_menu_item_3($child_0);
                    $html .= '<ul class="dropdown-menu">';

                    foreach ($child_0->children as $child_1)
                    {
                        if(isset($child_1->children) && render_menu_item_3($child_1) != false)
                        {
                            $html .= '<li class="list-group-item clearfix dropdown">';
                            $html .= render_menu_item_3($child_1);
                            $html .= '<ul class="dropdown-menu">';

                                foreach ($child_1->children as $child_2)
                                {
                                    if(isset($child_2->children) && render_menu_item_3($child_2) != false)
                                    {
                                        $html .= '<li class="list-group-item clearfix dropdown">';
                                        $html .= render_menu_item_3($child_2);
                                        $html .= '<ul class="dropdown-menu">';

                                        foreach ($child_2->children as $child_3)
                                        {
                                            if(render_menu_item_3($child_3) != false)
                                            {
                                                $html .= '<li class="list-group-item clearfix">';
                                                $html .= render_menu_item_3($child_3);
                                                $html .= '<ul class="dropdown-menu">';
                                            }
                                        }

                                        $html .= '</ul>';
                                        $html .= '</li>';
                                    }
                                    elseif(render_menu_item_3($child_2) != false)
                                    {
                                        $html .= '<li class="list-group-item clearfix">';
                                        $html .= render_menu_item_3($child_2);
                                        $html .= '</li>';
                                    }
                                }

                            $html .= '</ul>';
                            $html .= '</li>';
                        }
                        elseif(render_menu_item_3($child_1) != false)
                        {
                            $html .= '<li class="list-group-item clearfix">';
                            $html .= render_menu_item_3($child_1);
                            $html .= '</li>';
                        }
                    }

                    $html .= '</ul>';
                    $html .= '</li>';
                }
                elseif(render_menu_item_3($child_0) != false)
                {
                    $html .= '<li class="list-group-item clearfix">';
                    $html .= render_menu_item_3($child_0);
                    $html .= '</li>';
                }

            }

            $html .= '</ul>';

            return $html;
        }

        return false;
    }
}

if (!function_exists('render_mobile_main_menu')) {
    function render_mobile_main_menu()
    {
        $menu = Menu::where('position', 'MOBILE')->first();

        if($menu != null)
        {
            $data = json_decode($menu->data);

            $html = '';
            foreach ($data as $item)
            {
                if (isset($item->children) && render_menu_item_2($item) != false)
                {
                    $html .= '<li>';
                    $html .= render_menu_item_2($item);
                    $html .= '<ul>';

                    foreach($item->children as $child_1)
                    {
                        if (isset($child_1->children) && render_menu_item_2($child_1))
                        {
                            $html .= '<li>';
                            $html .= render_menu_item_2($child_1);
                            $html .= '<ul>';

                            foreach($child_1->children as $child_2)
                            {
                                if (isset($child_2->children) && render_menu_item_2($child_2))
                                {
                                    $html .= '<li>';
                                    $html .= render_menu_item_2($child_2);
                                    $html .= '<ul>';

                                    foreach($child_2->children as $child_3)
                                    {
                                        if(render_menu_item_2($child_3) != false)
                                        {
                                            $html .= '<li>'.render_menu_item_2($child_3).'</li>';
                                        }
                                    }

                                    $html .= '</ul>';
                                    $html .= '</li>';
                                }
                                else
                                {
                                    if(render_menu_item_2($child_2) != false)
                                    {
                                        $html .= '<li>'.render_menu_item_2($child_2).'</li>';
                                    }
                                }
                            }

                            $html .= '</ul>';
                            $html .= '</li>';
                        }
                        else
                        {
                            if(render_menu_item_2($child_1))
                            {
                                $html .= '<li>'.render_menu_item_2($child_1).'</li>';
                            }
                        }
                    }

                    $html .= '</ul>';
                    $html .= '</li>';
                }
                else
                {
                    if(render_menu_item_2($item) != false)
                    {
                        $html .= '<li>'.render_menu_item_2($item).'</li>';
                    }
                }
            }

            return $html;
        }

        return false;
    }
}

