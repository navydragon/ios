<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;




class User extends Authenticatable
{
    use Notifiable, AuthenticationLogable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    

    protected $guarded = ['role_id'];

    //protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function my_projects ()
    {
       return $this->hasMany('App\Project','author_id');
    }

    public function event_files($event_id)
    {
        return $this->hasMany('App\EventUserFile')->where('event_id','=',$event_id);
    }


    public function survey_attempts_in_event($event_id)
    {
        
        return SurveyAttempt:: where([
                    ['event_id', '=', $event_id],
                    ['user_id', '=', $this->id],
                    ])->get();
    }

    public function test_attempts_in_event($event_id)
    {
        
        return TestAttempt:: where([
                    ['event_id', '=', $event_id],
                    ['user_id', '=', $this->id],
                    ])->get();
    }

    public function get_join_date() {

    return Carbon::parse($this->pivot->join_date)->format('d.m.Y');
}
    
    public function forum_messages()
    {
        return $this->hasMany('App\ThreadMessage','author_id', 'id');
    }

    public function get_event_mark_by_expert($event, $expert)
    {
        $ea = EventAssessment::where ([
            ['event_id','=',$event],
            ['expert_id','=',$expert],
            ['user_id','=',$this->id],
        ])->get();
        if (count ($ea) > 0)
        {
            return $ea->first()->mark;
        }else{
            return "";
        }
    }

    public function get_event_competence_mark_by_expert($event, $expert, $competence)
    {
        $eca = EventCompetenceAssessment::where ([
            ['event_id','=',$event],
            ['expert_id','=',$expert],
            ['competence_id','=',$competence],
            ['user_id','=',$this->id],
        ])->get();
        if (count($eca) > 0)
        {
            return $eca->first()->mark;    
        }else{
            return "";
        }    
    }

    public function get_event_criteria_by_expert($event, $expert, $criteria)
    {
        $eca = EventCriteriaAssessment::where ([
            ['event_id','=',$event],
            ['expert_id','=',$expert],
            ['criteria_id','=',$criteria],
            ['user_id','=',$this->id],
        ])->get();
        if (count($eca) > 0)
        {
            return $eca->first()->mark;    
        }else{
            return "";
        } 
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial','filial_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }

    public function project_role($project_id)
    {
       return DB::table('project_user')
       ->where('user_id','=',$this->id)
       ->where('project_id','=',$project_id)
       ->get()->first()->role_id;
    }

    public function local_events()
    {
        return $this->hasMany('App\EventResult','user_id')->with('event')->get();
    }

    public function admin_access($filial_id)
    {
        if (Auth::user()->role_id == 1)
        {
            return true;
        }else if ($filial_id == Auth::user()->filial_id)
        {
           return true;
        }else{
            return false;
        }
    }
}
