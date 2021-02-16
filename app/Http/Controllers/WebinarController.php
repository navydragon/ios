<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webinar;
use App\Project;
use App\Event;
use App\WebinarParticipation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WebinarController extends Controller
{
    public function index()
    {
        $planned_webinars = Webinar::where('start_date','>=',Carbon::today())->get();
        $completed_webinars = Webinar::where('start_date','<',Carbon::today())->get();
        return view('webinars.index',compact('planned_webinars','completed_webinars'));
    }

    public function show($webinar)
    {
        $webinar = Webinar::findOrFail($webinar);
        if ($webinar->start_date >= Carbon::today())
        {$type = 'planned';}else{$type='completed';}
        return view('webinars.show',compact('webinar','type'));
    }

    function show_in_project(Project $project, Event $event, Webinar $webinar)
    {
        $webinar = Webinar::findOrFail($webinar->id);
        if ($webinar->start_date >= Carbon::today())
        {$type = 'planned';}else{$type='completed';}
        return view('projects.webinars.show',compact('event','webinar','type'));
    }

    public function go($webinar)
    {
        $webinar = Webinar::findOrFail($webinar);
        $w_p = WebinarParticipation::where('webinar_id','=', $webinar->id)->where('user_id','=',Auth::user()->id)->get();
        if (count($w_p) == 0)
        {
            $w_p = new WebinarParticipation;
            $w_p->webinar_id = $webinar->id;
            $w_p->user_id = Auth::user()->id;
            $w_p->participation_date = Carbon::now();
            $w_p->type = "Участие в вебинаре";
            $w_p->save();
        }
        return redirect($webinar->url);
    }

    public function view($webinar)
    {
        $webinar = Webinar::findOrFail($webinar);
        $w_p = WebinarParticipation::where('webinar_id','=', $webinar->id)->where('user_id','=',Auth::user()->id)->where('type','=','Просмотр записи')->get();
        if (count($w_p) == 0)
        {
            $w_p = new WebinarParticipation;
            $w_p->webinar_id = $webinar->id;
            $w_p->user_id = Auth::user()->id;
            $w_p->participation_date = Carbon::now();
            $w_p->type = "Просмотр записи";
            $w_p->save();
        }
        return redirect($webinar->recording_url);
    }
}
