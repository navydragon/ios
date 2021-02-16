<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventComment;
use App\ProjectStage;
use App\Project;
use App\LearningModule;
use App\Survey;
use App\Test;
use App\Task;
use App\LearningCase;
use App\EventResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function moveup(Event $event)
    {
    	$upper = Event::where([
    		['sort','=',$event->sort-1],
    		['project_stage_id','=',$event->project_stage_id],
    	])->first();
    	$upper->sort = $upper->sort + 1;
    	$upper->save();
    	$event->sort = $event->sort - 1;
    	$upper->save();
    	$event->save();
    	return back();
    }

    public function movedown(Event $event)
    {
    	$downer = Event::where([
    		['sort','=',$event->sort+1],
    		['project_stage_id','=',$event->project_stage_id],
    	])->first();
    	$downer->sort = $downer->sort - 1;
    	$downer->save();
    	$event->sort = $event->sort + 1;
    	$downer->save();
    	$event->save();
    	return back();
    }

    public function delete_event(Project $project, Event $event)
    {
        $ep = $event->event_parameter;
        $ep->delete();
        $ps = $event->stage;
        $event->delete();
        $n = 1;
        foreach ($ps->events as $ev)
        {
            $ev->sort = $n;
            $ev->save();
            $n++;
        }
        
        return back()->with('success_delete', 'Мероприятие удалено из оценочной сессии!');
    }

    public function add_comment(Event $event, Request $request)
    {
        $e_c = new EventComment;
        $e_c->event_id = $event->id;
        $e_c->author_id = Auth::user()->id;
        $e_c->comment = $request->comment;
        $e_c->save();
        return back()->with('add_comment','Комментарий добавлен!');
        
    }

    public function local_events_index()
    {
        $user_id = Auth::user()->id;
        $events = Event::where('is_local','=',true)->with('event_parameter')
        ->with(['event_results' => function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        }])
        ->whereHas('event_parameter', function ($query) {
            return $query->where('max_date', '>=', Carbon::now());
        })->get();
        return view('local_events.index',compact('events'));
    }

    public function local_events_completed()
    {
        $user_id = Auth::user()->id;
        $events = Event::where('is_local','=',true)->with('event_parameter')
        ->with(['event_results' => function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        }])
        ->whereHas('event_parameter', function ($query) {
            return $query->where('max_date', '<=', Carbon::now());
        })->get();
        return view('local_events.completed',compact('events'));
    }

    

    public function show_event (Event $event)
    {
        if ($event->is_local == false)
        {
            $project = $event->stage->project;
            $back_link = '/projects/'.$project->id;
        }else{ $project = null; $back_link = '/local_events';}
        switch($event->event_type_id)
        {
            case 1:
                $survey = Survey::findOrFail($event->source_id);
                return view('projects.surveys.show',compact('event','survey','project','back_link'));
            break;
            case 2:
                $er = EventResult::firstOrNew(['event_id' => $event->id,'user_id' => Auth::user()->id]);
                $er->last_activity = Carbon::now();
                $er->is_passed = true;
                $er->save();
                $learning_module = LearningModule::findOrFail($event->source_id);
                return view('projects.learning_modules.show',compact('event','learning_module','project','back_link'));
            break;

            case 3:
                $test = Test::findOrFail($event->source_id);
                $event = Event::findOrFail($event->id);
                $event->event_parameter = $event->event_parameter;
    	        return view('projects.tests.show',compact('event','test','project','back_link'));
            break;

            case 5:
                $task = Task::findOrFail($event->source_id);
                $event = Event::findOrFail($event->id);
                $event->event_parameter = $event->event_parameter;
    	        return view('projects.tasks.show',compact('event','task','project','back_link'));
            break;

            case 6:
                $case = LearningCase::findOrFail($event->source_id);
                $event = Event::findOrFail($event->id);
                $event->event_parameter = $event->event_parameter;
                $case_results = $case->results($event->id,Auth::user()->id);
    	        return view('projects.cases.show',compact('event','case','project','back_link','case_results'));
            break;
        }
    }
   
}
