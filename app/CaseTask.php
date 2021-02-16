<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseTask extends Model
{
    public function user_answer($user_id,$event_id)
    {
       return $this->belongsToMany('App\User','user_case_tasks')
       ->withPivot('answer')
       ->wherePivot('event_id', '=', $event_id)
       ->wherePivot('user_id','=',$user_id)->get();
    }
}
