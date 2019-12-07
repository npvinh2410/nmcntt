<?php

namespace Hydrogen\Menu\Models;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 'data', 'position'
    ];

    public function the_name()
    {
         return $this->name;
    }

    public function the_position()
    {
        return $this->position;
    }


}