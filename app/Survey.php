<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public function questions()
    {
    	return $this->hasMany('App\SurveyQuestion')->orderBy('sort');
    }

    public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',1)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}
