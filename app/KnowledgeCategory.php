<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeCategory extends Model
{
    public function materials()
    {
        return $this->hasMany('App\KnowledgeMaterial','category_id')->latest();
    }
}
