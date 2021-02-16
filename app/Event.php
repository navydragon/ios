<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Survey;
use App\SurveyAttempt;
use App\TestAttempt;
use App\LearningModule;
use App\Webinar;
use App\Task;
use App\EventResult;



class Event extends Model
{
    public function description()
    {
    	$e_d = [];
    	switch ($this->event_type_id) 
    	{
    		case 1: $e_d["type"]='Анкета'; $event=Survey::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='surveys/'.$event->id; $e_d["icon"] = "/images/accordeon-anketa.png"; $e_d["type_link"] = "survey"; break;
            case 2: $e_d["type"]='Учебный материал'; $event=LearningModule::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='learning_modules/'.$event->id; $e_d["icon"] = "/images/accordeon-metod.png"; $e_d["type_link"] = "learning_module"; break;
            case 3: $e_d["type"]='Тестирование'; $event=Test::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='tests/'.$event->id; $e_d["icon"] = "/images/accordeon-test.png"; $e_d["type_link"] = "test"; break;
            case 4: $e_d["type"]='Вебинар'; $event=Webinar::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='webinars/'.$event->id; $e_d["icon"] = "/images/accordeon-video.png"; $e_d["type_link"] = "webinar"; break;
            case 5: $e_d["type"]='Задание'; $event=Task::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='tasks/'.$event->id; $e_d["icon"] = "/images/accordeon-task.png"; $e_d["type_link"] = "task"; break;
            case 6: $e_d["type"]='Кейс'; $event=LearningCase::findOrFail($this->source_id); $e_d["name"] = $event->name; $e_d["sublink"]='cases/'.$event->id; $e_d["icon"] = "/images/accordeon-keys.png"; $e_d["type_link"] = "case"; break;
    		default:  $e_d["type"]='Не определено'; $e_d["icon"]="/images/accordeon-other.png"; $e_d["title"] = '-'; break;
    	}
    	return (object)$e_d;
    	//return dd($e_d);
    }

    public function user_count()
    {
        switch ($this->event_type_id) 
        {
            case 1: 
                $kol = SurveyAttempt::where('event_id','=',$this->id)->get()->count();
            break;
            case 3: 
                $kol = DB::table('test_attempts')->select('user_id')->where('event_id','=',$this->id)->distinct()->get()->count();
            break;
            case 5: 
                $kol = DB::table('event_user_files')->select('user_id')->where('event_id','=',$this->id)->distinct()->get()->count();
            break;
            default: $kol="???"; break;
        }
        return $kol;
    }

    public function survey_attempts()
    {
        return $this->hasMany('App\SurveyAttempt');
    }

    public function test_attempts()
    {
        return $this->hasMany('App\TestAttempt');
    }

    public function stage()
    {
        return $this->belongsTo('App\ProjectStage','project_stage_id');
    }

    public function competences()
    {
        return $this->belongsToMany('App\Competence', 'event_competence', 'event_id', 'competence_id');
    }

    public function criterias()
    {
        return $this->hasMany('App\EventCriteria');
    }

    public function user_success($user)
    {
       switch ($this->event_type_id) 
        {
            case 1: 
                $kol = SurveyAttempt::where('event_id','=',$this->id)
                ->where('user_id','=',$user)
                ->get()->count();
            break;
            case 3: 
                $kol = DB::table('test_attempts')->select('user_id')
                ->where('event_id','=',$this->id)
                ->where('user_id','=',$user)
                ->get()->count();
            break;
            case 5: 
                $kol = DB::table('event_user_files')->select('user_id')
                ->where('event_id','=',$this->id)
                ->where('user_id','=',$user)
                ->get()->count();
            break;
            default: $kol=0; break;
        }
        if ($kol > 0) {return true;}
        return false;
    }

    public function event_parameter()
    {
    	return $this->belongsTo('App\EventParameter','event_parameter_id');
    }

    public function comments()
    {
        return $this->hasMany('App\EventComment');
    }

    public function is_passed($user_id)
    {
        $res = EventResult::where('user_id','=',$user_id)->where('event_id','=',$this->id)->where('is_passed','=',true)->get();
        if ($res->count() == 0) { return false; }
        return true;
    }

    public function event_results()
    {
        return $this->hasMany('App\EventResult'); 
    }

    public function event_result($user_id)
    {
        $e_r = EventResult::where('event_id','=',$this->id)->where('user_id','=',$user_id)->get();
        return $e_r;
    }
}
