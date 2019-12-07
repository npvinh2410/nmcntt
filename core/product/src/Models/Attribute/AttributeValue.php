<?php

namespace Hydrogen\Product\Models\Attribute;


use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attributeValues';

    protected $fillable = [
        'attributes_id', 'value'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attributes_id', 'id');
    }

    public function the_value()
    {
        return $this->value;
    }


}