<?php
namespace Hydrogen\Slider\Models;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'name', 'position'
    ];

    public function slides() {
        return $this->hasMany(Slide::class)->orderBy('priority');
    }

    public function the_name()
    {
        return $this->name;
    }

    public function the_position()
    {
        return $this->position;
    }

}