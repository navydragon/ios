<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\Survey;
use  App\SurveyAttempt;
use  App\SurveyAnswer;
use App\EventResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{
    // public function pr_show(Project $project, Event $event, Survey $survey)
    // {
    // 	return view('projects.surveys.show',compact('project','event','survey'));
    // }

    public function store_results(Event $event, Survey $survey, Request $request)
    {
    	$attempt = SurveyAttempt::updateOrCreate(
  	  ['event_id' => $event->id, 'user_id' => Auth::user()->id],
      ['survey_id' => $survey->id]
		);

    	$deletedRows = SurveyAnswer::where('attempt_id', $attempt->id)->delete();
        foreach ($request->q as $key => $value) {
           $answer = new SurveyAnswer;
           $answer->attempt_id = $attempt->id;
           $answer->question_id = $key;
           $answer->answer_text = $value;
           $answer->save();
        }
		$er = EventResult::firstOrNew(['event_id' => $event->id,'user_id' => Auth::user()->id]);
        $er->last_activity = Carbon::now();
        $er->is_passed = true;
        $er->save();
         if ($event->is_local == true)
         {
             return redirect('/local_events')->with('success','Результаты успешно сохранены!');
         }
         return back()->with('success','Результаты успешно сохранены!');
    }
}
