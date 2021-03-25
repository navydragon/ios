<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectRole;

class Project extends Model
{
    public function stages()
    {
    	return $this->hasMany('App\ProjectStage');
    }

    public function events()
    {
        $events = 0;
        $stages = $this->hasMany('App\ProjectStage')->get();
        foreach ($stages as $stage)
        {
            $events += $stage->hasMany('App\Event')->count();
        }
        return $events;
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'project_user', 'project_id', 'user_id')->withPivot('role_id','join_date');
    }

    public function members()
    {
        return $this->users();
    }

    public function hasUser($user_id)
    {
    	$a = $this->users()->find($user_id);
    	if ($a)
    	{
    		return true;
    	}else
    	{
    		return false;
    	}
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

     public function competences()
    {
        return $this->belongsToMany('App\Competence', 'project_competence', 'project_id', 'competence_id');
    }

    public function p_status()
    {
        return $this->belongsTo('App\ProjectStatus','status');
    }

}
