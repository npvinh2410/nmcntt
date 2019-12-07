<?php
namespace Hydrogen\Post\Models;

use Hydrogen\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
    ];

    public function translations()
    {
        return $this->hasMany(CategoryContent::class, 'cat_id', 'id');
    }

    public function translate($lang_code) {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'category')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function parent()
    {
        return $this->belongsTo( Category::class, 'parent_id');
    }

    public function getParent() {
        return $this->parent();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id')
            ->orderBy('created_at', 'desc');
    }

    public function get_posts()
    {
        return $this->posts()->paginate(get_setting('post_per_page'));
    }

    public function the_breadcrumbs()
    {
        return 'category';
    }
}