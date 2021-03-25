<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
     public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',4)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }

    public function participations()
    {
        return $this->hasMany('App\WebinarParticipation');
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}
