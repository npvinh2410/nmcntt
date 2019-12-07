<?php

namespace Hydrogen\Widget\Models;


use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'positions',
    ];

    public function translations() {
        return $this->hasMany(WidgetTranslate::class, 'widget_id', 'id');
    }

    public function translate($lang_code) {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }
}