<?php

namespace Hydrogen\Product\Models\Catalog;


use Hydrogen\Product\Models\Product\Product;
use Hydrogen\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';

    protected $fillable = [
        'parent_id'
    ];

    public function translations()
    {
        return $this->hasMany(CatalogTrans::class, 'catalog_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'catalog')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function parent()
    {
        return $this->belongsTo(Catalog::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Catalog::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productCatalog', 'catalog_id', 'product_id')
            ->orderBy('created_at', 'desc');
    }

    public function get_products()
    {
        return $this->products()->paginate(get_setting('product_per_page'));
    }

    public function the_breadcrumbs()
    {
        return 'catalog';
    }

}