<?php


namespace Hydrogen\Setting\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value'
    ];

}