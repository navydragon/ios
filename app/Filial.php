<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    public function users()
    {
        return $this->hasMany('App\User','filial_id');
    }
}
