<?php

namespace Hydrogen\Product\Models\Attribute;


use Illuminate\Database\Eloquent\Model;

class AttributeTrans extends Model
{
    protected $table = 'attributesTrans';

    protected $fillable = [
        'name', 'attributes_id', 'lang_code'
    ];


    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attributes_id', 'id');
    }

    public function the_name()
    {
        return $this->name;
    }

    public function the_lang_code()
    {
        return $this->lang_code;
    }

}