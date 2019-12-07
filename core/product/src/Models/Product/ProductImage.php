<?php

namespace Hydrogen\Product\Models\Product;


use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'productImages';

    protected $fillable = [
        'img', 'priority', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function the_img()
    {
        return $this->img;
    }

    public function the_priority()
    {
        return $this->priority;
    }
}