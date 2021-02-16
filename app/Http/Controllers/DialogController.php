<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dialog;
use App\DialogMessage;
use Illuminate\Support\Facades\Auth;
class DialogController extends Controller
{
    public function add_message(Dialog $dialog, Request $request)
    {
        $message = new DialogMessage;
        $message->dialog_id = $dialog->id;
        $message->message = $request->message;
        $message->author_id = Auth::user()->id;
        $message->save();
        return back();
    }
}
