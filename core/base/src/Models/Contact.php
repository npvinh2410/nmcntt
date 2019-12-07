<?php

namespace Hydrogen\Base\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name', 'phone', 'mail', 'note', 'status'
    ];

    public function the_name()
    {
        return $this->name;
    }

    public function the_phone()
    {
        return $this->phone;
    }

    public function the_mail()
    {
        return $this->mail;
    }

    public function the_note()
    {
        return $this->note;
    }

    public function the_status()
    {
        if($this->status == false)
        {
            return 'In Process';
        }
        else
        {
            return 'Complete';
        }
    }
}