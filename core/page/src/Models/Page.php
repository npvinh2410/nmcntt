<?php

namespace Hydrogen\Page\Models;

use Hydrogen\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'template'
    ];


    public function translations()
    {
        return $this->hasMany(PageContent::class,'page_id', 'id');
    }

    public function translate($lang_code)
    {
        return $this->translations()->where('lang_code', '=', $lang_code)->first();
    }

    public function seos($lang_code)
    {
        return Seo::where('owner_type', 'page')->where('owner_id', $this->id)->where('lang_code', $lang_code)->first();
    }

    public function the_breadcrumbs()
    {
        return 'page';
    }

}
