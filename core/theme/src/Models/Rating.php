<?php

namespace Hydrogen\Theme\Models;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table= 'ratings';

    protected $fillable = ['owner_type', 'owner_id', 'rating', 'number_rating'];
}