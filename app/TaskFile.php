<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    public function source()
    {
    	return $this->belongsTo('App\File','file_id');
    }
}
