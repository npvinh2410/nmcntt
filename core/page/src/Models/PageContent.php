<?php

namespace Hydrogen\Page\Models;


use Hydrogen\Base\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $table = 'pageContent';

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'thumbnail', 'lang_code', 'status', 'user_id', 'page_id'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class,'page_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function the_slug()
    {
        return $this->slug;
    }

    public function the_title()
    {
        return $this->title;
    }

    public function the_excerpt()
    {
        return $this->excerpt;
    }

    public function the_excerpt2()
    {
        $rs = [];
        $tmp = explode("\r\n", $this->excerpt);

        foreach ($tmp as $item)
        {
            $tmp2 = explode(':', $item, 2);
            $rs[$tmp2[0]] = $tmp2[1];
        }

        return $rs;
    }

    public function the_content()
    {
        return $this->content;
    }

    public function the_thumbnail($size = null)
    {
        if($this->thumbnail != null)
        {
            $filename = explode('.', $this->thumbnail);

            switch ($size) {
                case 'thumb':
                    return $filename[0] . '-' . config('media.sizes.thumb') . '.' . $filename[1];
                    break;
                case 'featured':
                    return $filename[0] . '-' . config('media.sizes.featured') . '.' . $filename[1];
                    break;
                case 'medium':
                    return $filename[0] . '-' . config('media.sizes.medium') . '.' . $filename[1];
                    break;
                case 'sidebar':
                    return $filename[0] . '-' . config('media.sizes.sidebar') . '.' . $filename[1];
                    break;
                default:
                    return $this->thumbnail;
            }
        }
        else
        {
            return asset('backend/images/misc/placeholder.png');
        }
    }

    public function the_status()
    {
        return $this->status;
    }

    public function the_lang_code()
    {
        return $this->lang_code;
    }

    public function the_hyperlink() {
        return $this->slug;
    }
}