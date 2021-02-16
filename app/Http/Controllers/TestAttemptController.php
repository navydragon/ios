<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestAttempt;
use App\TestQuestion;
use App\TestAnswer;
use App\AttemptResult;
use App\EventResult;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TestAttemptController extends Controller
{
     public function show_attempt($testattempt)
    {
    	$ta = TestAttempt::findOrFail($testattempt);
    	return view('projects.tests.attempts.show',compact('ta'));
    }

    public function show_summary($testattempt, Request $request)
    {
    	$ta = TestAttempt::findOrFail($testattempt);
    	
    	 foreach ($request->get('questions') as $key => $val) {
            //ищем вопрос в базе
                $question = TestQuestion::findOrFail($key);
                foreach ($question->answers as $answer) {
                
                if (is_array($val)) {
                    if (in_array($answer->id, $val)) {
                        $a = AttemptResult::firstOrNew (['attempt_id' => $ta->id,'question_id' => $question->id, 'answer_id' => $answer->id]);
						$a->checked = true;
						$a->right = $answer->right;
						$a->save();
                    } else {
                        $a = AttemptResult::firstOrNew (['attempt_id' => $ta->id,'question_id' => $question->id, 'answer_id' => $answer->id]);
						$a->checked = false;
						$a->right = $answer->right;
                        $a->save();
                    }
                } else {
                    if ($val==$answer->id) {
                        $a = AttemptResult::firstOrNew (['attempt_id' => $ta->id,'question_id' => $question->id, 'answer_id' => $answer->id]);
						$a->checked = true;
						$a->right = $answer->right;
						$a->save();
                    } else {
                        $a = AttemptResult::firstOrNew (['attempt_id' => $ta->id,'question_id' => $question->id, 'answer_id' => $answer->id]);
						$a->checked = false;
						$a->right = $answer->right;
						$a->save();
						
                    }
                }
            }
         
        }
        return view('projects.tests.attempts.summary',compact('ta'));
    }

    public function save_attempt($testattempt)
    {
       $ta = TestAttempt::findOrFail($testattempt);
       $ta->status = 1;
       $score = 0;
       foreach($ta->test->questions as $question)
       {
            if ($question->is_right($ta->id) == true)
            {
                $score++;
            }
       }
       $ta->score = $score;
       if ($score >= ($ta->test->questions->count()) * 0.7 )
       {
            $ta->result = 1;
       }else{
            $ta->result = 0;
       }
       $ta->save();

       $event = $ta->event;
       $er = EventResult::firstOrNew(['event_id' => $event->id,'user_id' => Auth::user()->id]);
       $er->last_activity = Carbon::now();
       if ( $ta->result == 1)
       {
            $er->is_passed = true;
       }else{
            $er->is_passed = false;
       }
       $er->save(); 
       return redirect('/tests/attempts/'.$ta->id.'/review');
    }

    public function review_attempt($testattempt)
    {
        $ta = TestAttempt::findOrFail($testattempt);
        return view('projects.tests.attempts.review',compact('ta'));
    }
}
