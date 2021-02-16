<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    public function messages()
    {
        return $this->hasMany('App\DialogMessage','dialog_id');
    }

    public function author_1()
    {
        return $this->belongsTo('App\User','user1');
    }

    public function author_2()
    {
        return $this->belongsTo('App\User','user2');
    }

    public function last_message()
    {
        return $this->hasOne('App\DialogMessage','dialog_id')->latest();
    }
}
