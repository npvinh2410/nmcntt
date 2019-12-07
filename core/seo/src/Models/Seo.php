<?php
namespace Hydrogen\Seo\Models;


use Illuminate\Database\Eloquent\Model;

class Seo extends Model {

    protected $table  = 'seos';

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'canonical',
        'lang_code',
        'owner_type',
        'owner_id',
    ];

    public function the_title()
    {
        return $this->title;
    }

    public function the_description()
    {
        return $this->description;
    }

    public function the_keywords()
    {
        return $this->keywords;
    }

    public function the_canonical()
    {
        return $this->canonical;
    }
}