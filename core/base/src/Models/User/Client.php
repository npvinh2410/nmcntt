<?php

namespace Hydrogen\Base\Models\User;


use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'address','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}