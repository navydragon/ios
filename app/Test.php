<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\User;

class Test extends Model
{
    public function questions()
    {
    	return $this->hasMany('App\TestQuestion');
    }

    public function questions_in_test($n)
    {
        return $this->hasMany('App\TestQuestion')->get()->random($n);
    }
 
    public function user_attempts($user_id,$event_id)
    {
        return $this->hasMany('App\TestAttempt')
        ->where('user_id','=',$user_id)
        ->where('event_id','=',$event_id);
    }

    public function find_in_stage($stage)
    {
    	
    	$events = Event::where('event_type_id', '=',3)->where('project_stage_id','=',$stage)->where('source_id','=',$this->id);
    	return $events;
    }

    public function show_questions($event_id)
    {
        
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public function scopeFilial($query,$filial_id)
    {
        return $query->where('votes', '>', 100);
    }
    
}
