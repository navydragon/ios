<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\Test;
use App\TestAttempt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function show($project, $event, $test)
    {
    	$project = Project::findOrFail($project);
        $test = Test::findOrFail($test);
        $event = Event::findOrFail($event);
        $event->event_parameter = $event->event_parameter;
    	return view('projects.tests.show',compact('project','event','test'));
    }

    public function new_attempt($event, $test)
    {
    	$test = Test::findOrFail($test);
    	$event = Event::findOrFail($event);

    	$att = DB::table('test_attempts')->where([
    	['user_id','=',Auth::user()->id],
    	['test_id','=',$test->id],
    	['event_id','=',$event->id],
    	['status','=',0],
    	])->get();
    	if (count($att) == 0)
    	{
	    	$na = new TestAttempt;
	    	$na->test_id = $test->id;
	    	$na->event_id = $event->id;
	    	$na->user_id = Auth::user()->id;
	    	$na->save();
	    	return redirect('/events/'.$event->id.'/tests/attempts/'.$na->id);
	    }else{
	    	$ta = $att->first();
            $ta = TestAttempt::find($ta->id);
	    	return view('projects.tests.attempts.show',compact('ta','event'));
	    }
    }

   
}
