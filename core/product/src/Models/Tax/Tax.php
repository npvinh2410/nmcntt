<?php

namespace Hydrogen\Product\Models\Tax;


use Hydrogen\Product\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';

    protected $fillable = [
        'name', 'value'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'tax_id', 'id');
    }

    public function the_name()
    {
        return $this->name;
    }

    public function the_value()
    {
        return $this->value;
    }
}