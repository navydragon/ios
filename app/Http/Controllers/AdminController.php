<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectStage;
use App\User;
use App\Event;
use App\Ticket;
use App\ThreadMessage;
use Calendar;
class AdminController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
    	//$users = User::latest('created_at')->limit(10)->get();
    	 $users = User::all();
       $evs = Event::all();
       $tickets = Ticket::all()->where('status','=',1);
    	$events = []; 
       	$data = ProjectStage::all();
       	$messages = ThreadMessage::latest('updated_at')->limit(5)->get();
       	if($data->count())
       	{
          foreach ($data as $el) 
          {
            $events[] = [
            	'id' => $el->id,
            	'title' => $el->name,
            	'start' => $el->start_date,
            	'end' => $el->end_date,
            ];
          }
        }
    	return view('admin.index',compact('projects','users','events','messages','evs','tickets'));
    }
}
