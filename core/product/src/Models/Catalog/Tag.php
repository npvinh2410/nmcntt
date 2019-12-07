<?php

namespace Hydrogen\Product\Models\Catalog;


use Hydrogen\Product\Models\Product\Product;
use Hydrogen\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'parent_id'
    ];

    public function translations()
    {
        return $this->hasMany(TagTrans::class, 'tag_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'tag')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productTag', 'tag_id', 'product_id');
    }
}