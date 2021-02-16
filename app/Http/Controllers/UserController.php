<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dialog;
use App\DialogMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Event;
class UserController extends Controller
{
    public function user_settings()
    {
    	return view('personal.settings');
    }

    public function update_avatar(Request $request)
    {
    	$request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
		
		$user = Auth::user();
		$avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('public/avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();
    	return back();
    }

    public function delete_avatar()
    {
    	$user = Auth::user();
    	$user->avatar = "user.jpg";
    	$user->save();
    	return back();
    }

    public function change_password(Request $request)
    {
    	$user = Auth::user();
    	if (Hash::check($request->current_pass,$user->password))
    	{
    		if ($request->new_pass == $request->new_pass_repeat)
    		{
    			$user->password = bcrypt($request->new_pass);
    			$user->save();
    			return back()->with('success','Пароль успешно изменен!');
    		}else{
    			return back()->with('error','Введенные пароли не совпадают!');	
    		}
    	}else{
    		return back()->with('error','Текущий пароль указан неверно!');
    	}
    }

    public function update_personal_info(Request $request)
    {
    	$request->validate([
            'email' => 'required|email',
        ]);
    	$user = Auth::user();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->division = $request->division;
    	$user->job = $request->job;
    	$user->additional_email = $request->additional_email;
    	$user->additional_phone = $request->additional_phone;
    	$user->save();
    	return back();
    }

    public function reset_password(User $user)
    {
        $user->password = Hash::make('111111');
        $user->save();
        return back()->with('success_role', 'Пароль сброшен на базовый!'); ;
    }

    public function user_dialogs()
    {
        $dialogs = Dialog::where('user1','=',Auth::user()->id)->orWhere('user2','=',Auth::user()->id)->with('last_message')->get();
        $users = User::with('filial:id,name')->get();
        //$users = User::all();
        return view('personal.dialogs.index',compact('dialogs','users'));
    }

    public function add_dialog(Request $request)
    {
        if ($request->user_id == null) {return back()->with('error_add_dialog', 'Выберите с кем начать диалог'); }
        $dialogs = Dialog::where('user1','=',$request->user_id)->where('user2','=',Auth::user()->id);
        $dialogs = $dialogs->where('user1','=',Auth::user()->id)->where('user2','=',$request->user_id)->get();
        if (count($dialogs) == 0) 
        {
            $dialog = new Dialog;
            $dialog->user1 = Auth::user()->id;
            $dialog->user2 = $request->user_id;
            $dialog->updated = Carbon::now();
            $dialog->save();
            $message = new DialogMessage;
            $message->dialog_id = $dialog->id;
            $message->message = $request->message;
            $message->author_id = Auth::user()->id;
            $message->is_read = false;
            $message->save();
        }else{
            $dialog = $dialogs->first();
            $dialog->updated = Carbon::now();
            $message = new DialogMessage;
            $message->dialog_id = $dialog->id;
            $message->message = $request->message;
            $message->author_id = Auth::user()->id;
            $message->is_read = false;
            $message->save();
        }
        return redirect('/user_dialogs/'.$dialog->id);
    }

    public function show_user_dialog($dialog)
    {
        $dialog = Dialog::findOrFail($dialog);
        //$dialog = $dialog->with('messages')->get()->first();
        
        return view('personal.dialogs.show',compact('dialog'));
    }

    public function user_projects()
    {
        $projects = Auth::user()->projects()->orderByDesc('end_date')->get();
        return view('personal.projects.index',compact('projects'));
    }

    public function user_local()
    {
        $user_id = Auth::user()->id;
        $events = Event::where('is_local','=',true)
        ->with('event_parameter')
        ->with(['event_results' => function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        }])
        ->get()
        ->sortByDesc(function($event, $key) {
            return $event->event_parameter->max_date;
          });
        return view('personal.local.index',compact('events'));
    }
}