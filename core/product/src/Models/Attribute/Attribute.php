<?php

namespace Hydrogen\Product\Models\Attribute;

use Hydrogen\Product\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    protected $fillable = [
        'type'
    ];

    public function translations()
    {
        return $this->hasMany(AttributeTrans::class,'attributes_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attributes_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productAttribute', 'attribute_id', 'product_id');
    }


    public function the_type()
    {
        return $this->type;
    }

}