<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
