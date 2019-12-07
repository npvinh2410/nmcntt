<?php
namespace Hydrogen\Post\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostContent extends Model {

    protected $table = 'postContent';

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'thumbnail', 'lang_code', 'status', 'user_id', 'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id', 'id');
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

    public function the_excerpt($length = 0) {
        $excerpt = "";
        if ($length) {

            if ($this->excerpt) {
                $excerpt .= get_n_words_from_string($this->excerpt, $length);
                $excerpt .= " ...";
            } else {
                $excerpt .= get_n_words_from_string(strip_tags($this->content), $length);
            }

        } else {
            if ($this->excerpt) {
                $excerpt .= $this->excerpt;
            } else {
                $excerpt .= get_n_words_from_string(strip_tags($this->content), 30);
            }
        }

        return $excerpt;
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

    public function the_hyperlink() {
        return $this->slug;
    }

    public function the_status()
    {
        return $this->status;
    }

    public function the_lang_code()
    {
        return $this->lang_code;
    }
}