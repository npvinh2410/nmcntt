<?php
namespace Hydrogen\Post\Models;

use Hydrogen\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Hydrogen\Base\Models\Rating;

class Post extends Model {
    protected $table = 'posts';
    protected $fillable = [
        'template', 'main_cat'
    ];

    public function main_cate()
    {
        return $this->belongsTo(Category::class, 'main_cat', 'id');
    }

    public function translations()
    {
        return $this->hasMany(PostContent::class,'post_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'post')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function attachCategory($category)
    {
        if(is_object($category)) {
            $category = $category->getKey();
        }

        if(is_array($category)) {
            $category = $category['id'];
        }

        $this->categories()->attach($category);
    }

    public function detachCateogories() {
        $categories = $this->categories()->get();

        foreach ($categories as $category) {
            $this->categories()->detach($category->id);
        }
    }


    public function inCat($category_id)
    {
        foreach($this->categories as $category) {
            if ($category->id == $category_id) {
                return true;
            }
        }

        return false;
    }

    public function the_breadcrumbs()
    {
        return 'post';
    }
}