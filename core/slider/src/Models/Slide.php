<?php
namespace Hydrogen\Slider\Models;
use Illuminate\Database\Eloquent\Model;
class Slide extends Model
{
    protected $table = 'slides';

    protected $fillable = [
        'slider_id', 'name', 'image', 'href', 'target', 'follow'
    ];

    public function slider() {
        return $this->belongsTo(Slider::class);
    }

}