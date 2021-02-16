<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Event;
use App\Task;


class TaskController extends Controller
{
    public function show(Project $project, Event $event, Task $task)
    {
    	return view('projects.tasks.show',compact('project','event','task'));
    }
}
