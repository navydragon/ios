<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Project;
use App\Task;
use App\Event;
use App\EventUserFile;
use App\EventResult;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class EventUserFileController extends Controller
{
    public function store(Event $event, $task, Request $request)
    {

    	if ($request->hasFile('upl'))
    	{
    		$source = $request->file('upl');
    		$file = new File;
    		$path = $file->upload($source);
    		$file->user_id = Auth::user()->id;
    		$file->title = 'Задание_'.Auth::user()->name;
    		$file->path = $path;
    		$file->type = $source->getClientOriginalExtension();
    		$file->save();

    		$file_bind = new EventUserFile;
    		$file_bind->event_id = $event->id;
    		$file_bind->user_id = Auth::user()->id;
    		$file_bind->file_id = $file->id;

			$file_bind->save();

			$er = EventResult::firstOrNew(['event_id' => $event->id,'user_id' => Auth::user()->id]);
			$er->last_activity = Carbon::now();
			if ($event->event_type_id == 5)
			{
				$er->is_passed = true;
			}
			$er->save(); 
		}

       
    	return back();
    }
}
