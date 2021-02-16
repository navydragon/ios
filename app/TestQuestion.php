<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TestAttempt;

class TestQuestion extends Model
{
   	public function type()
   	{
   		return $this->belongsTo('App\QuestionType');
   	}

   	public function answers()
   	{
   		return $this->hasMany('App\TestAnswer','question_id');
   	}



   	public function is_answered($test_attempt)
   	{
   		$a = $this->hasMany('App\AttemptResult','question_id')->where('attempt_id','=',$test_attempt)->get();
   		if (count($a) > 0)
   		{
   			return 'kek';
   		}else{
   			return false;
   		}
   	}

   	public function is_right($test_attempt)
   	{
   		$right = true;
   		$results = $this->hasMany('App\AttemptResult','question_id')->where('attempt_id','=',$test_attempt)->get();
   		foreach ($results as $result) {
   			if ( ($result["right"] == 1) && ($result["checked"] == 0) ) { $right = false; }
   			if ( ($result["right"] == 0) && ($result["checked"] == 1) ) { $right = false; }
   		}
   		return $right;
   	}

      public function right_answers_in_event($event_id)
      {
         $result = 0;
         $attempts = TestAttempt::all()->where('event_id','=',$event_id);
         foreach($attempts as $attempt)
         {
            if ($this->is_right($attempt->id) == true)
            {
               $result = $result + 1;
            }
         }
         return $result.' ('.round($result / count($attempts) * 100).'%)';
      }

      public function bad_answers_in_event($event_id)
      {
         $result = 0;
         $attempts = TestAttempt::all()->where('event_id','=',$event_id);
         foreach($attempts as $attempt)
         {
            if ($this->is_right($attempt->id) == false)
            {
               $result = $result + 1;
            }
         }
         return $result.' ('.round($result / count($attempts) * 100).'%)';
      }
}
