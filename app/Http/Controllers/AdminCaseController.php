<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LearningCase;
use App\CaseFile;
use App\CaseTask;
use App\File;

class AdminCaseController extends Controller
{
    public function index()
    {
    	$cases = LearningCase::all();
    	return view('admin.cases.index',compact('cases'));
    }

    public function store(Request $request)
    {
    	$case = new LearningCase;
    	$case->name = $request->name;
    	$case->author_id = Auth::user()->id;
        $case->save();
        
    	return redirect('/adm/cases/'.$case->id.'/edit');
    }

    public function show(LearningCase $case)
    {
    	return view('admin.cases.show',compact('case'));
    }

    public function edit(LearningCase $case)
    {
        $tasks = $case->tasks()->orderBy('sort')->get();
        return view('admin.cases.edit',compact('case','tasks'));
    }

    public function update(LearningCase $case, Request $request)
    {
        $case = LearningCase::findOrFail($case->id);
        $case->name = $request->name;
        $case->conditions = $request->conditions;
        $case->description = $request->description;
        $case->short_description = $request->short_description;
        $case->weight = $request->weight;
        //$case->task = $request->task;
        $case->categories = $request->categories;
        //$case->possible_errors = $request->possible_errors;
        //$case->error_effects = $request->error_effects;
        //$case->algorithms = $request->algorithms;
        //$case->conclusions = $request->conclusions;
        if ($request->is_recommend) 
        {   
            if ($request->is_recommend == 'on')
            {
                $case->is_recommend = true;
            }else { $case->is_recommend = false; }
        }
        
        $case->save();
        return back()->with('success','Параметры кейса успешно обновлены!');
    }

    public function add_file(LearningCase $case, Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/cases/'.$case->id.'/',$name);
        $file_t = new File;
        $file_t->user_id = Auth::user()->id;
        $file_t->title = $request->name;
        $file_t->path = 'cases/'.$case->id.'/'.$name;
        $file_t->type = $file->getClientOriginalExtension();
        $file_t->save();
        $case_file = new CaseFile;
        $case_file->learning_case_id = $case->id;
        $case_file->file_id = $file_t->id;
        $case_file->save();
        return back()->with('success_file','Файл добавлен!');
    }

    public function delete_file($casefile)
    {
        $casefile = CaseFile::find($casefile);
        $file_t = $casefile->source;
        unlink($file_t->path);
        $casefile->delete();
        return back()->with('success_file','Файл удален!');
    }

    public function delete(LearningCase $case)
    {
        foreach ($case->files as $file)
        {
            $this->delete_file($file->id);
        }
        $case->delete();
        return back()->with('success','Кейс успешно удален!');
    }

    public function add_task(LearningCase $case, Request $request)
    {
        $ct = new CaseTask;
        $ct->task = $request->task;
        $ct->learning_case_id = $case->id;
        $ct->sort = CaseTask::where('learning_case_id','=',$case->id)->get()->count()+1;
        $ct->save();
        return back()->with('success_task','Задание добавлено!');
    }

    public function delete_task(LearningCase $case, CaseTask $task)
    {
        $task->delete();
        $n = 1;
        foreach ($case->tasks as $t)
        {
            $t->sort = $n;
            $t->save();
            $n++;
        }
        return back()->with('success_task','Задание кейса успешно удалено!');
    }

    public function move_up_task(LearningCase $case, $task)
    {
        $task = CaseTask::findOrFail($task);
        $upper = CaseTask::where([
    		['sort','=',$task->sort-1],
    		['learning_case_id','=',$case->id],
        ])->first();
    	$upper->sort = $upper->sort + 1;
    	$upper->save();
    	$task->sort = $task->sort - 1;
    	$upper->save();
    	$task->save();
    	return back()->with('success_task','Подядок изменен!');
    }

    public function move_down_task(LearningCase $case, $task)
    {
        $task = CaseTask::findOrFail($task);
        $downer = CaseTask::where([
    		['sort','=',$task->sort+1],
    		['learning_case_id','=',$case->id],
        ])->first();
    	$downer->sort = $downer->sort - 1;
    	$downer->save();
    	$task->sort = $task->sort + 1;
    	$downer->save();
    	$task->save();
        return back()->with('success_task','Подядок изменен!');
    }

    public function edit_task(LearningCase $case,CaseTask $task)
    {
        return view('admin.cases.edit_task',compact('case','task'));
    }

    public function update_task(LearningCase $case, CaseTask $task, Request $request)
    {
        $task = CaseTask::findOrFail($task->id);
        $task->task = $request->task;
        $task->save();
        return back()->with('success_task','Подядок изменен!');
    }
}
