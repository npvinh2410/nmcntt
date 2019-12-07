<?php


namespace Hydrogen\Seo\Models;


use Illuminate\Database\Eloquent\Model;

class SeoUpdate extends Model
{
    protected $table  = 'seo_update';

    protected $fillable = [
        'url',
        'title',
        'description',
        'keywords',
        'custom',
    ];
}