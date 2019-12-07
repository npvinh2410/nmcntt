<?php

namespace Hydrogen\Product\Models\Product;


use Illuminate\Database\Eloquent\Model;

class NewSale extends Model
{
    protected $table = 'sale_new';

    protected $fillable = [
        'product_id', 'type'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}