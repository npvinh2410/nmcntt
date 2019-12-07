<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Trang Chủ', route('root'));
});

// Page
Breadcrumbs::register('page', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(title_case($page->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $page->translate(get_current_lang_code())->the_hyperlink()]));
});

// Category
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(title_case($category->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $category->translate(get_current_lang_code())->the_hyperlink()]));
});


//// Post
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(title_case($post->main_cate->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $post->main_cate->translate(get_current_lang_code())->the_hyperlink()]));
    $breadcrumbs->push(title_case($post->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $post->translate(get_current_lang_code())->the_hyperlink()]));
});

// Product Category
Breadcrumbs::register('catalog', function ($breadcrumbs, $catalog) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(title_case($catalog->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $catalog->translate(get_current_lang_code())->the_hyperlink()]));
});

// Product
Breadcrumbs::register('product', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(title_case($product->mainCat->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $product->mainCat->translate(get_current_lang_code())->the_hyperlink()]));
    $breadcrumbs->push(title_case($product->translate(get_current_lang_code())->the_title()), route('view', ['slug' => $product->translate(get_current_lang_code())->the_hyperlink()]));
});


