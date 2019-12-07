<?php

namespace Hydrogen\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaShare extends Model
{

    use SoftDeletes;
    protected $table = 'media_shares';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['share_type', 'share_id', 'shared_by', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'share_id');
    }

    public function file()
    {
        return $this->belongsTo(MediaFile::class, 'share_id');
    }
}
