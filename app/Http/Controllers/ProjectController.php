<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Competence;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{  
	public function index()
	{
        $menu_slot = 'projects';
		$active_projects =  Project::where('status','=',2)->get();
		return view('projects.index',compact('active_projects','menu_slot'));	
    }
    
    public function index_completed()
	{
        $menu_slot = 'projects';
		$completed_projects =  Project::where('status','=',4)->get();
		return view('projects.index_completed',compact('completed_projects','menu_slot'));	
	}
    public function show(Project $project)
    {
        $menu_slot = 'projects';
    	return view('projects.show',compact('project','menu_slot'));
    }

    public function add_user_to_project(Project $project, User $user)
    {
    	$project->users()->attach($user, ['role_id' => 1,'join_date' => date("Y-m-d")]);
    	return redirect()->route('project_show', [$project]);
    }

    public function show_project_results(Project $project)
    {
        return view('projects.show_results',compact('project'));
    }
    
}
