<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectStage extends Model
{
    public function events()
    {
    	return $this->hasMany('App\Event')->with('event_parameter')->orderBy('sort');
    }

    public function live_events($stage,$date)
    {
        $date = Carbon::createFromFormat("d.m.Y", $date)->format('Y-m-d');;
        $events = DB::table('live_events')->where([
            ['stage_id','=',$stage],
            ['date','=',$date]
        ])->orderBy('start_time')->get();
        return $events;
        /*
        ])*/
        return $this->hasMany('App\LiveEvent','stage_id');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function get_start_date()
    {
    	return Carbon::parse($this->start_date)->format('d.m.Y');
    }

    public function get_end_date()
    {
    	return Carbon::parse($this->end_date)->format('d.m.Y');
    }
}
