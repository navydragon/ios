<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TestAnswer extends Model
{
    public function is_chosen($test_attempt)
   	{
           $a = $this->hasMany('App\AttemptResult','answer_id')->where('attempt_id','=',$test_attempt)->get()->first();
   		if ($a && $a["checked"])
   		{
   			return true;
   		}else{
   			return false;
   		}
   	}

   public function count_in_event($event)
   {
      return DB::table('test_attempts')
      ->join('attempt_results', 'test_attempts.id', '=', 'attempt_results.attempt_id')
      ->where('test_attempts.event_id', $event)
      ->where('attempt_results.answer_id','=',$this->id)
      ->where('attempt_results.checked','=','1')
      ->get()->count();
   }
}
