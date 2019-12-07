<?php

namespace Hydrogen\Media\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class MediaSetting extends Model
{
    protected $table = 'media_settings';
    protected $fillable = ['key', 'value', 'user_id'];
    public function getValueAttribute($value)
    {
        try {
            return json_decode($value, true) ?: [];
        } catch (Exception $exception) {
            return [];
        }
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = json_encode($value);
    }
}