<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\EventParameter;
use App\Test;
use App\Survey;
use App\Task;
use App\LearningModule;
use App\LearningCase;
use App\Webinar;
use App\User;
use App\SurveyAttempt;
use App\EventResult;
use Illuminate\Support\Facades\Auth;

class AdminEventController extends Controller
{
    public function index()
    {
    	$events = Event::where('is_local','=',true)->with('author:id,filial_id')->get();
    	return view('admin.local_events.index',compact('events'));
    }

    public function view_possible_tests()
    {
        $tests = Test::with('author:id,filial_id')->withCount('questions')->get();
       
        
        return view('admin.local_events.modals.view_possible_tests',compact('tests'));
    }

    public function view_possible_surveys()
    {
        $surveys = Survey::with('author:id,filial_id')->withCount('questions')->get();
        return view('admin.local_events.modals.view_possible_surveys',compact('surveys'));
    }

    public function view_possible_tasks()
    {
        $tasks = Task::with('author:id,filial_id')->get();
        return view('admin.local_events.modals.view_possible_tasks',compact('tasks'));
    }

    public function view_possible_materials()
    {
        $materials = LearningModule::with('author:id,filial_id')->get();
        return view('admin.local_events.modals.view_possible_materials',compact('materials'));
    }

    public function view_possible_cases()
    {
        $cases = LearningCase::with('author:id,filial_id')->get();
        return view('admin.local_events.modals.view_possible_cases',compact('cases'));
    }

    public function view_possible_webinars()
    {
        $webinars = Webinar::with('author:id,filial_id')->get();
        return view('admin.local_events.modals.view_possible_webinars',compact('webinars'));
    }

    public function add_test (Request $request)
    {
        $e_t = 3;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->test_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->show_questions = $request->show_questions;
        $e_p->passing_score = $request->passing_score;
        $e_p->max_attempts = $request->max_attempts;
        $e_p->attempt_time = $request->attempt_time;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_survey (Request $request)
    {
        $e_t = 1;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->survey_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_task (Request $request)
    {
        $e_t = 5;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->task_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_material (Request $request)
    {
        $e_t = 2;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->material_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_case (Request $request)
    {
        $e_t = 6;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->case_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_webinar (Request $request)
    {
        $e_t = 4;
        $event = new Event; 
        $event->event_type_id = $e_t;
        $event->source_id = $request->webinar_id;
        $event->is_local = true;
        $event->author_id = Auth::user()->id;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    function delete_local_event(Event $event)
    {
        $ep = $event->event_parameter;
        $ep->delete();
        $event->delete();
        
        return back()->with('success_delete', 'Локальное мероприятие удалено!');
    }   

    function show_local_event (Event $event)
    {
        $ev = $event->description();
        $ep = $event->event_parameter;
        return view ('admin.local_events.show',compact('event','ev','ep'));
    }

    function edit_local_event (Event $event)
    {
        $ev = $event->description();
        $ep = $event->event_parameter;
        return view ('admin.local_events.edit',compact('event','ev','ep'));
    }

    function update_local_event (Event $event, Request $request)
    {
        $ep = EventParameter::find($event->event_parameter_id);
        $ep->max_date = $request->max_date;
        if (isset ($request->show_questions)) { $ep->show_questions = $request->show_questions; }
        if (isset ($request->passing_score)) { $ep->passing_score = $request->passing_score; }
        if (isset ($request->max_attempts)) { $ep->max_attempts = $request->max_attempts; }
        if (isset ($request->attempt_time)) { $ep->attempt_time = $request->attempt_time; }
        $ep->save();
        return back()->with('success','Параметры обновлены');
    }

    function event_user_result(Event $event, User $user)
    {
        $ep = $event->event_parameter;
        $er = EventResult::where('event_id','=',$event->id)->where('user_id','=',$user->id)->get()->first();
        switch ($event->event_type_id)
        { 
            case 1:
                $survey = Survey::findOrFail($event->source_id);
                $last_attempt = SurveyAttempt::where('event_id','=',$event->id)->where('user_id','=',$user->id)->get()->first();
                return view('admin/events/results/survey',compact('event','user','survey','last_attempt','ep','er'));
            break;
            case 2:
                $lm = LearningModule::findOrFail($event->source_id);
                return view('admin/events/results/learning_module',compact('event','user','lm','ep','er'));
            break;
            case 3:
                $test = Test::findOrFail($event->source_id);
                $last_attempt = $test->user_attempts($user->id,$event->id)->latest()->get()->first();
                $qsta = $last_attempt->attempt_results()->select('question_id')->distinct()->get();
                $qs = [];
                foreach ($qsta as $q)
                {
                    array_push($qs,$q->question);
                }
                return view('admin/events/results/test',compact('event','user','test','last_attempt','ep','er','qs'));
            break;
            case 5:
                $task = Task::findOrFail($event->source_id);
                $files = $user->event_files($event->id)->get();
                return view('admin/events/results/task',compact('event','user','task','files','ep','er'));
            break; 
            case 6:
                $case = LearningCase::findOrFail($event->source_id);
                $case_tasks = $case->tasks; 
                $case_results = $case->results($event->id,$user->id);
                return view('admin/events/results/case',compact('event','user','case','case_tasks','ep','er','case_results'));
            break;
        }
    }
}
