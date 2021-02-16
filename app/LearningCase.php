<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningCase extends Model
{
    public function files()
    {
    	return $this->hasMany('App\CaseFile');
    }

    public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',6)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }

    public function tasks()
    {
    	return $this->hasMany('App\CaseTask')->orderBy('sort');
    }

    public function author()
    {
    	return $this->belongsTo('App\User','author_id');
    }

    public function results($event_id,$user_id)
    {
        return $this->hasmany('App\CaseResult','learning_case_id')
        ->where('user_id','=',$user_id)
        ->where('event_id','=',$event_id)
        ->get();
    }
}
