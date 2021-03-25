<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestAttempt;
use App\TestQuestion;
use App\TestAnswer;
use App\AttemptResult;
use App\EventResult;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TestAttemptController extends Controller
{
     public function show_attempt(Event $event, $testattempt)
    {
    	$ta = TestAttempt::findOrFail($testattempt);
        $qsta = $ta->attempt_results()->select('question_id')->distinct()->get();
        $qs = [];
        if (count($qsta) > 0)
        {
            foreach ($qsta as $q)
            {
                array_push($qs,$q->question);
            }
        }else{
            $ep = $event->event_parameter;
            $qs = $ta->test->questions_in_test($ep->show_questions);
        }
        
        //dd($ta);
    	return view('projects.tests.attempts.show',compact('ta','event','qs'));
    }

    public function show_summary(Event $event,$testattempt, Request $request)
    {
        //dd($request->get('questions') );
    	$ta = TestAttempt::findOrFail($testattempt);
    	$qs = [];
    	 foreach ($request->get('questions') as $key => $val) {
            //ищем вопрос в базе
                $question = TestQuestion::findOrFail($key);
                array_push($qs,$question);
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
        return view('projects.tests.attempts.summary',compact('ta','qs','event'));
    }

    public function save_attempt(Event $event,$testattempt)
    {
       $ta = TestAttempt::findOrFail($testattempt);
       $ta->status = 1;
       $ps = $event->event_parameter->passing_score;
       $score = 0;
       $qsta = $ta->attempt_results()->select('question_id')->distinct()->get();
       foreach($qsta as $q)
       {
            $question = TestQuestion::findOrFail($q->question_id);
            if ($question->is_right($ta->id) == true)
            {
                $score++;
            }
       }
       $ta->score = $score;
       if ($score >= $ps )
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
       return redirect('events/'.$event->id.'/tests/attempts/'.$ta->id.'/review');
    }

    public function review_attempt(Event $event,$testattempt)
    {
        $ta = TestAttempt::findOrFail($testattempt);
        $qsta = $ta->attempt_results()->select('question_id')->distinct()->get();
        $qs = [];
        foreach ($qsta as $q)
        {
            array_push($qs,$q->question);
        }
        return view('projects.tests.attempts.review',compact('event','ta','qs'));
    }
}
