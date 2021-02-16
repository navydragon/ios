<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\LearningModule;
class LearningModuleController extends Controller
{
        public function pr_show(Project $project, Event $event, LearningModule $learning_module)
    {
    	return view('projects.learning_modules.show',compact('project','event','learning_module'));
    }
}
