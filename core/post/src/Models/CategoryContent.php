<?php
namespace Hydrogen\Post\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model {
    protected $table = 'categoryContent';
    protected $fillable = [
        'slug', 'title', 'excerpt', 'lang_code', 'cat_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function the_title()
    {
        return $this->title;
    }

    public function the_slug()
    {
        return $this->slug;
    }

    public function the_excerpt()
    {
        return $this->excerpt;
    }

    public function the_hyperlink() {
        return $this->slug;
    }
}