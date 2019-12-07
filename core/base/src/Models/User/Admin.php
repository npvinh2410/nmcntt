<?php

namespace Hydrogen\Base\Models\User;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}