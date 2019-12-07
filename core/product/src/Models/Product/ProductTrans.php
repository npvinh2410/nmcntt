<?php

namespace Hydrogen\Product\Models\Product;


use Hydrogen\Product\Models\Attribute\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductTrans extends Model
{
    protected $table = 'productTrans';

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'price_on_sale', 'discount', 'status', 'lang_code', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'productAttribute', 'productTrans_id', 'attribute_id')->select(['id', 'type', 'value']);
    }


    public function attachAttribute($attribute, $value)
    {
        if(is_object($attribute)) {
            $attribute = $attribute->getKey();
        }

        if(is_array($attribute)) {
            $attribute = $attribute['id'];
        }

        $this->attributes()->attach($attribute, ['value' => $value]);
    }

    public function detachAttribute() {
        $attributes = $this->attributes()->get();

        foreach ($attributes as $attribute) {
            $this->attributes()->detach($attribute->id);
        }
    }


    public function inAttr($attribute_id)
    {
        foreach($this->attributes() as $attribute) {
            if ($attribute->id == $attribute_id) {
                return true;
            }
        }

        return false;
    }

    public function the_title()
    {
        return $this->name;
    }

    public function the_slug()
    {
        return $this->slug;
    }

    public function the_excerpt($length = 0)
    {
        $description = "";
        if ($length) {

            if ($this->description) {
                $description .= get_n_words_from_string($this->description, $length);
                $description .= " ...";
            }

        } else {
            if ($this->description) {
                $description .= $this->description;
            }
        }

        return $description;
    }

    public function the_price()
    {
        return $this->price;
    }

    public function the_price_on_sale()
    {
        return $this->price_on_sale;
    }

    public function the_discount()
    {
        return $this->discount;
    }

    public function the_status()
    {
        return $this->status;
    }

    public function the_lang_code()
    {
        return $this->lang_code;
    }



    public function the_hyperlink() {
        return $this->slug;
    }

    public function render_price()
    {
        $html = '';

        if($this->the_price_on_sale())
        {
            $html .= '<div class="pi-price" itemprop="price" content="'.$this->the_price_on_sale().'"><span itemprop="priceCurrency" content="'.__('theme::index.currency_seo').'">'.__('theme::index.currency').'</span>'.number_format($this->the_price_on_sale()).'</div>
                        <div class="pi-price-2" itemprop="price" content="'.$this->the_price().'"><span itemprop="priceCurrency" content="'.__('theme::index.currency_seo').'">'.__('theme::index.currency').'</span>'.number_format($this->the_price()).'</div>';
        }
        else
        {
            $html .= '<div class="pi-price" itemprop="price" content="'.$this->the_price().'"><span itemprop="priceCurrency" content="'.__('theme::index.currency_seo').'">'.__('theme::index.currency').'</span>'.number_format($this->the_price()).'</div>';
        }

        return $html;
    }
}