<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeMaterial extends Model
{
    public function file()
    {
    	return $this->belongsTo('App\File','file_id');
    }

    public function comments()
    {
        return $this->hasMany('App\KnowledgeMaterialComment','material_id');
    }

    public function tags()
    {
        return $this->hasMany('App\KnowledgeMaterialTag','material_id');
    }

    public function category()
    {
        return $this->belongsTo('App\KnowledgeCategory','category_id');
    }

    
}
