<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',5)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }

    public function files()
    {
    	return $this->hasMany('App\TaskFile');
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}
