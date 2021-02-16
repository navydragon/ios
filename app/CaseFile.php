<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
    public function source()
    {
    	return $this->belongsTo('App\File','file_id');
    }
}
