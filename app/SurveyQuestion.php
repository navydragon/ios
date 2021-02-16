<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SurveyAttempt;
use App\SurveyAnswer;

class SurveyQuestion extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_answer_in_event($user_id, $event_id)
    {
    	$attempt =  SurveyAttempt:: where([
		    		['user_id', '=', $user_id],
		   			['event_id', '=', $event_id],
					])->get();
    	if (count($attempt) != 0)
    	{
    		$attempt = $attempt->first();
    		$answered_question = SurveyAnswer:: where([
		    		['attempt_id', '=', $attempt->id],
		   			['question_id', '=', $this->id],
					])->first();
            if ($answered_question)
            {
    		return $answered_question->answer_text;
            }else{
                return null;
            }

    	}else
    	{
    		return null;
    	}

    }

    public function user_answers($event_id)
    {
        $answers = [];
        $attempts = SurveyAttempt:: where([['event_id', '=', $event_id],])->get();
        foreach ($attempts as $attempt)
        {
            $answers = $attempt->answers->where('question_id','=',$this->id);
        }
        return $answers;
    }
}
