<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\ForumThread;
use App\ThreadMessage;
use Illuminate\Support\Facades\Auth;
class ForumController extends Controller
{
    public function index()
    {
        $menu_slot = 'forums';
        $forums = Forum::where('visible',true)->get();
        foreach ($forums as $forum)
        {
            $forum->last_message = $forum->last_message;
        }
    	return view('forum.index',compact('forums','menu_slot'));	
    }

    public function show(Forum $forum)
    {
        $menu_slot = 'forums';
    	return view('forum.show',compact('forum','menu_slot'));
    }

    public function show_thread(Forum $forum, ForumThread $thread)
    {
        $menu_slot = 'forums';
    	return view('forum.show_thread',compact('forum','thread','menu_slot'));
    }

    public function store_thread(Forum $forum, Request $request)
    {
    	 if ($request->message_text && $request->name)
    	 {
    	 	$thread = new ForumThread;
         	$thread->forum_id = $forum->id;
         	$thread->author_id = Auth::user()->id;
         	$thread->name = $request->name;
         	$thread->save();

         	$message = new ThreadMessage;
         	$message->forum_thread_id = $thread->id;
         	$message->author_id = Auth::user()->id;
         	$message->message = $request->message_text;
         	$message->save();
         	return view('forum.show_thread',compact('forum','thread'));
         }
         
         return back();
    }

    public function store_message(Forum $forum, ForumThread $thread, Request $request)
    {
    	 if ($request->message_text)
    	 {
    	 	$message = new ThreadMessage;
         	$message->forum_thread_id = $thread->id;
         	$message->author_id = Auth::user()->id;
         	$message->message = $request->message_text;
         	$message->save();
         }

         return back();
    }
}
