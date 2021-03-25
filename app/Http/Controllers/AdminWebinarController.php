<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webinar;
use App\WebinarParticipation;
use App\Event;
use Illuminate\Support\Facades\Auth;

class AdminWebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::with('author:id,filial_id')->get();
    	return view('admin.webinars.index',compact('webinars'));
    }

    public function store(Request $request)
    {
        $webinar = new Webinar;
        $webinar->name = $request->name;
        $webinar->start_date = $request->start_date;
        $webinar->description = $request->description;
        $webinar->url = $request->url;
        $webinar->room_link = " ";
        $webinar->admin_url = $request->admin_url;
        $webinar->author_id = Auth::user()->id;
        $webinar->save();
        return back();
    }

    public function show($webinar)
    {
        $webinar = Webinar::findOrFail($webinar);
        $participations = WebinarParticipation::with('user')->where('webinar_id','=',$webinar->id)->get();
        return view('admin.webinars.show',compact('webinar','participations'));
    }

    public function edit($webinar)
    {
        $webinar = Webinar::findOrFail($webinar);
        return view('admin.webinars.edit',compact('webinar'));
    }

    public function update(Webinar $webinar, Request $request)
    {
        $webinar = Webinar::findOrFail($webinar->id);
        $webinar->name = $request->name;
        $webinar->start_date = $request->start_date;
        $webinar->description = $request->description;
        $webinar->url = $request->url;
        $webinar->admin_url = $request->admin_url;
        $webinar->recording_url = $request->recording_url;
        $webinar->save();
        return back()->with('success','Параметры вебинара успешно обновлены!');
    }

    public function delete(Webinar $webinar)
    {
        $events = Event::where('event_type_id','=',4)->where('source_id','=',$webinar->id)->get();
        foreach ($events as $event) { $event->delete();}
        $webinar->delete();
        return back()->with('success_delete','Вебинар успешно удален!');
    }
}
