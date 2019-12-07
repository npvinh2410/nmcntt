<?php

namespace Hydrogen\Product\Models\Catalog;


use Illuminate\Database\Eloquent\Model;

class CatalogTrans extends Model
{
    protected $table = 'catalogTrans';

    protected $fillable = [
        'slug', 'title', 'excerpt', 'lang_code', 'catalog_id'
    ];

    protected function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id', 'id');
    }

    public function the_slug()
    {
        return $this->slug;
    }

    public function the_title()
    {
        return $this->title;
    }

    public function the_excerpt()
    {
        return $this->excerpt;
    }

    public function the_lang_code()
    {
        return $this->lang_code;
    }

    public function the_hyperlink()
    {
        return $this->slug;
    }

}