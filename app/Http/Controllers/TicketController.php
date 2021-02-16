<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\TicketType;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\TicketFile;

class TicketController extends Controller
{
   public function index()
   {
   		$tickets = Ticket::all();
   		$ticket_types = TicketType::all();
    	return view('admin.tickets.index',compact('tickets','ticket_types'));
   }

   public function store(Request $request)
   {
   	 $ticket = new Ticket;
   	 $ticket->name = $request->name;
   	 $ticket->description = $request->description;
   	 $ticket->ticket_type_id = $request->type;
   	 $ticket->user_id = Auth::user()->id;
   	 $ticket->status = 1;
   	 $ticket->save();

   	 if ($request->hasFile('files'))
	    {
	        foreach ($request->files as $file)
	        {
	            $name = $file->getClientOriginalName();
	            $file->move(storage_path().'/app/public/ticket_files/'.$ticket->id.'/',$name);
	            $file_t = new File;
	            $file_t->user_id = Auth::user()->id;
	            $file_t->title = $name;
	            $file_t->path = '/ticket_files/'.$ticket->id.'/'.$name;
	            $file_t->type = $file->getClientOriginalExtension();
	            $file_t->save();
	            $ticket_file = new TicketFile;
	            $ticket_file->ticket_id = $ticket->id;
	            $ticket_file->file_id = $file_t->id;
	            $ticket_file->save();
	        }
	    }
   	 return back();
   }

   public function show(Ticket $ticket)
   {
   		return view('admin.tickets.show',compact('ticket'));
   }

   public function add_files(Ticket $ticket, Request $request)
   {
   		if ($request->hasFile('files'))
        {
            foreach ($request->files as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(storage_path().'/app/public/ticket_files/'.$ticket->id.'/',$name);
                $file_t = new File;
                $file_t->user_id = Auth::user()->id;
                $file_t->title = $name;
                $file_t->path = '/ticket_files/'.$ticket->id.'/'.$name;
                $file_t->type = $file->getClientOriginalExtension();
                $file_t->save();
                $ticket_file = new TicketFile;
                $ticket_file->ticket_id = $ticket->id;
                $ticket_file->file_id = $file_t->id;
                $ticket_file->save();
            }
            return back();
        }
        return back();
   }
}
