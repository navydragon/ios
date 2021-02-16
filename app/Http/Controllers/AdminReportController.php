<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Project;
use App\User;
use App\Filial;

class AdminReportController extends Controller
{
    public function index()
    {
        $events = Event::where('is_local','=',true)->get();
        $projects = Project::with('p_status')->get();
        $users = User::with('filial')->latest()->get();
        $filials = Filial::all();
        return view('admin.reports.index',compact('projects','events','users','filials'));
    }

    public function show_event(Event $event)
    {
        return view('admin.reports.event',compact('event'));
    }

    public function show_project(Project $project)
    {
        return view('admin.reports.project',compact('project'));
    }

    public function show_user(User $user)
    {
        return view('admin.reports.user',compact('user'));
    }
}
