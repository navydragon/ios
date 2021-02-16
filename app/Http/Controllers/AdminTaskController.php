<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Task;
use App\TaskFile;
use App\File;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminTaskController extends Controller
{
    public function index()
    {
    	$tasks = Task::all();
    	return view('admin.tasks.index',compact('tasks'));
    }

    public function store(Request $request)
    {
        
    	$task = new Task;
    	$task->name = $request->name;
    	$task->author_id = Auth::user()->id;
    	if($request->description)
    	{
    		$task->description = $request->description;	
    	}else
    	{
    		$task->description = ' ';
    	}
    	$task->text = ' ';
    	$task->save();
        /*
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file)
            {
                //$file->storeAs('public/task_files/'.$task->id,$file->getClientOriginalName());
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/tasks/'.$task->id.'/',$name);
                $file_t = new File;
                $file_t->user_id = Auth::user()->id;
                $file_t->title = 'Задание';
                $file_t->path = 'tasks/'.$task->id.'/'.$name;
                $file_t->type = $file->getClientOriginalExtension();
                $file_t->save();
                $task_file = new TaskFile;
                $task_file->task_id = $task->id;
                $task_file->file_id = $file_t->id;
                $task_file->save();
            }
        }
        */
    	return redirect('/adm/tasks/'.$task->id.'/edit');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show',compact('task'));
    }
    public function edit(Task $task)
    {
    	return view('admin.tasks.edit',compact('task'));
    }

    public function update(Task $task, Request $request)
    {
        $task->name = $request->name;
        if($request->description)
        {
            $task->description = $request->description; 
        }else
        {
            $task->description = ' ';
        }
        if($request->text)
        {
            $task->text = $request->text; 
        }else
        {
            $task->text = ' ';
        }
        $task->save();
        return back()->with('success','Параметры успешно обновлены!');
    }

    public function add_file(Task $task, Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/tasks/'.$task->id.'/',$name);
        $file_t = new File;
        $file_t->user_id = Auth::user()->id;
        $file_t->title = $request->name;
        $file_t->path = 'tasks/'.$task->id.'/'.$name;
        $file_t->type = $file->getClientOriginalExtension();
        $file_t->save();
        $task_file = new TaskFile;
        $task_file->task_id = $task->id;
        $task_file->file_id = $file_t->id;
        $task_file->save();
        return back()->with('success_file','Файл успешно добавлен!');
    }

    public function delete_file($taskfile)
    {
        $taskfile = TaskFile::find($taskfile);
        $file_t = $taskfile->source;
        unlink($file_t->path);
        $taskfile->delete();
        return back()->with('success_file','Файл успешно удален!');
    }

    public function delete(Task $task)
    {
        $events = Event::where('event_type_id','=',5)->where('source_id','=',$task->id)->get();
        foreach ($events as $event) { $event->delete();}
        
        foreach ($task->files as $taskfile)
        {
            $file_t = $taskfile->source;
            unlink($file_t->path);
            $taskfile->delete();
        }
        $task->delete();
        return back()->with('success_delete','Задание успешно удалено!');
    }

}
