<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\LearningCase;
use App\CaseTask;
use App\UserCaseTask;
use App\CaseResult;
use App\EventResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    // public function show(Project $project, Event $event, LearningCase $case)
    // {
    //     $case_results = $case->results($event->id,Auth::user()->id);
    // 	return view('projects.cases.show',compact('project','event','case','case_results'));
    // }

    public function store_task_answer(Event $event, LearningCase $case, $case_task, Request $request)
    {
        $case_task = CaseTask::findOrFail($case_task);
        $uct = UserCaseTask::where('event_id','=',$event->id)
        ->where('case_task_id','=',$case_task->id)->where('user_id','=',Auth::user()->id)->get();
        if ($uct->count() > 0)
        {
            $uct = $uct->first();
            $uct->answer = $request->answer;
            $uct->save();
        }else {
            $uct = new UserCaseTask;
            $uct->event_id = $event->id;
            $uct->case_task_id = $case_task->id;
            $uct->user_id = Auth::user()->id;
            $uct->answer = $request->answer;
            $uct->save();
        }

        $er = EventResult::firstOrNew(['event_id' => $event->id,'user_id' => Auth::user()->id]);
        $er->last_activity = Carbon::now();
        $er->save();

        $uct = UserCaseTask::where('event_id','=',$event->id)
        ->where('user_id','=',Auth::user()->id)->get();
        if ($uct->count() == $case->tasks()->count())
        {
            $er->is_passed = true;
            $er->save();
        }

        return back()->with('task_store_success',['Ответ сохранен!',$case_task->id]);
    }

    public function store_case_answer(Event $event, LearningCase $case, $type, Request $request)
    {
        $cr = CaseResult::firstOrNew(['event_id' => $event->id,'learning_case_id' => $case->id, 'user_id'=>Auth::user()->id ]);
        switch ($type){
            case "pe": $cr->possible_errors = $request->answer; break;
            case "ee": $cr->error_effects = $request->answer; break;
            case "al": $cr->algorithms = $request->answer; break;
            case "cs": $cr->conclusions = $request->answer; break;
        }
        $cr->save();
        return back()->with('task_store_success',['Ответ сохранен!',$type]);
    }
}
