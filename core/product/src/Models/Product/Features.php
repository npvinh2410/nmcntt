<?php
namespace Hydrogen\Product\Models\Product;


use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'features';

    protected $fillable = [
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}