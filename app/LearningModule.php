<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',2)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }
}
