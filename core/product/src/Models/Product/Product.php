<?php

namespace Hydrogen\Product\Models\Product;


use Hydrogen\Product\Models\Attribute\Attribute;
use Hydrogen\Product\Models\Catalog\Catalog;
use Hydrogen\Product\Models\Catalog\Tag;
use Hydrogen\Product\Models\Tax\Tax;
use Hydrogen\Seo\Models\Seo;
use Hydrogen\Theme\Models\Rating;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'sku', 'stock', 'thumbnail', 'template', 'main_cat', 'tax_id', 'related'
    ];

    public function features()
    {
        return $this->hasOne(Features::class, 'product_id', 'id');
    }

    public function new_sale()
    {
        return $this->hasOne(NewSale::class, 'product_id', 'id');
    }

    public function isFeatures()
    {
        $check = $this->features;

        if($check != null)
        {
            return true;
        }

        return false;
    }

    public function translations()
    {
        return $this->hasMany(ProductTrans::class,'product_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'product')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function related()
    {
        return Product::where('related', $this->related)->get();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function catalogs() {
        return $this->belongsToMany(Catalog::class, 'productCatalog', 'product_id', 'catalog_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'productTag', 'product_id', 'tag_id');
    }

    public function tags_id()
    {
        $tags_id = [];

        if($this->tags->isNotEmpty())
        {
            foreach ($this->tags as $tag)
            {

                $tags_id[] = $tag->id;
            }
        }
        return $tags_id;
    }

    public function attachCatalog($catalog)
    {
        if(is_object($catalog)) {
            $catalog = $catalog->getKey();
        }

        if(is_array($catalog)) {
            $catalog = $catalog['id'];
        }

        $this->catalogs()->attach($catalog);
    }

    public function detachCatalogs() {
        $catalogs = $this->catalogs()->get();

        foreach ($catalogs as $catalog) {
            $this->catalogs()->detach($catalog->id);
        }
    }


    public function inCat($catalog_id)
    {
        foreach($this->catalogs as $catalog) {
            if ($catalog->id == $catalog_id) {
                return true;
            }
        }

        return false;
    }

    public function attachTag($tag)
    {
        if(is_object($tag)) {
            $tag = $tag->getKey();
        }

        if(is_array($tag)) {
            $tag = $tag['id'];
        }

        $this->tags()->attach($tag);
    }

    public function detachTag() {
        $tags = $this->tags()->get();

        foreach ($tags as $tag) {
            $this->tags()->detach($tags->id);
        }
    }


    public function inTag($tag_id)
    {
        foreach($this->tags() as $tag) {
            if ($tag->id == $tag_id) {
                return true;
            }
        }

        return false;
    }

    public function mainCat()
    {
        return $this->belongsTo(Catalog::class, 'main_cat', 'id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }


    public function the_sku()
    {
        return $this->sku;
    }

    public function the_stock()
    {
        return $this->stock;
    }

    public function the_template()
    {
        return $this->template;
    }

    public function the_thumbnail($size = null)
    {
        if($this->thumbnail != null)
        {
            $filename = explode('.', $this->thumbnail);

            switch ($size) {
                case 'thumb':
                    return $filename[0] . '-' . config('media.sizes.thumb') . '.' . $filename[1];
                    break;
                case 'featured':
                    return $filename[0] . '-' . config('media.sizes.featured') . '.' . $filename[1];
                    break;
                case 'medium':
                    return $filename[0] . '-' . config('media.sizes.medium') . '.' . $filename[1];
                    break;
                case 'sidebar':
                    return $filename[0] . '-' . config('media.sizes.sidebar') . '.' . $filename[1];
                    break;
                default:
                    return $this->thumbnail;
            }
        }
        else
        {
            return asset('backend/images/misc/placeholder.png');
        }
    }

    public function the_breadcrumbs()
    {
        return 'product';
    }

    public function the_rating()
    {
        $rating = Rating::where('owner_type', 'product')->where('owner_id', $this->id)->first();

        $html = '<div class="ratings">';
        $html .= '<div class="pull-left">';

        if($rating != null)
        {
            $html .= '<input type="text" class="kv-gly-heart rating-loading" value="'.$rating->rating.'" data-size="xs" title=""
                   data-type="product" data-owner_id="'.$this->id.'">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">'.$rating->rating.'</span> sao, trên tổng số
                            <span itemprop="reviewCount">'.$rating->number_rating.'</span> lượt đánh giá.
                        </span>';
        }
        else
        {
            $html .= '<input type="text" class="kv-gly-heart rating-loading" value="0" data-size="xs" title=""
                   data-type="product" data-owner_id="'.$this->id.'">
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">0</span> sao, trên tổng số
                            <span itemprop="reviewCount">0</span> lượt đánh giá.
                        </span>';
        }

        $html .= '</div>';
        $html .= '<div class="clearfix"></div>';
        $html .= '</div>';

        echo $html;
    }
}