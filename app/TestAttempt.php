<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttemptResult;
use App\Event;
use App\ProjectStage;

class TestAttempt extends Model
{
	public function test()
	{
		return $this->belongsTo('App\Test');
	}

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

	public function project()
	{
		$event = $this->event;
		$event = Event::findOrFail($event->id);
		$project = $event->stage->project_id;
		
		return $project;
	}

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function text_status()
    {
    	if ($this->status == 0)
    	{
    		return 'В процессе';
    	}else{
    		if ($this->result == 1)
    		{
    			return 'Пройден';
    		}else{
    			return 'Не пройден';
    		}
    	}
    }

    public function attempt_results()
    {
    	return $this->hasMany('App\AttemptResult','attempt_id');
    }

}
