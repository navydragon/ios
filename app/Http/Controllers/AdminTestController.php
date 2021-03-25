<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\TestQuestion;
use App\TestAnswer;
use App\Event;
use Illuminate\Support\Facades\Auth;

class AdminTestController extends Controller
{
    public function index()
    {

    	$tests = Test::with('author:id,filial_id')->get();
    	return view('admin.tests.index',compact('tests'));
    }

    public function store(Request $request)
    {
    	$test = new Test;
    	$test->name = $request->name;
    	$test->author_id = Auth::user()->id;
    	if($request->description)
    	{
    		$test->description = $request->description;	
    	}else
    	{
    		$test->description = ' ';
    	}
    	
    	$test->save();
    	return redirect('/adm/tests/'.$test->id.'/edit');
    }

    public function update(Test $test,Request $request)
    {
        $test->name = $request->name;
        if($request->description)
        {
            $test->description = $request->description; 
        }else
        {
            $test->description = ' ';
        }
        
        $test->save();
        return redirect('/adm/tests/'.$test->id.'/edit')->with('success','Данные успещно обновлены!');
    }

    public function show(Test $test)
    {
    	return view('admin.tests.show',compact('test'));
    }

    public function edit(Test $test)
    {
        $questions = $test->questions()->orderBy('sort')->get();
        return view('admin.tests.edit',compact('test','questions'));
    }

    public function destroy(Test $test)
    {
        $events = Event::where('event_type_id','=',3)->where('source_id','=',$test->id)->get();
        foreach ($events as $event) { $event->delete();}
    	$tq = Test::findOrFail($test->id);
    	$tq->delete();
    	return back()->with('success_delete','Тест успешно удален!');
    }

    public function store_question(Test $test, Request $request)
    {
        //dd($request);
        $test_m = Test::findOrFail($test->id);
        $tq= new TestQuestion;
        $tq->test_id = $test->id;
        $tq->name = $request->name;
        $tq->type_id = $request->type;
        $tq->sort = TestQuestion::where('test_id','=',$test->id)->get()->count()+1;
        $tq->save();

        foreach ($request->a_t as $key => $value) {
            if ($value)
            {
                $ta = new TestAnswer;
                $ta->name = $value;
                $ta->question_id = $tq->id;
                if (isset($request->a_r[$key]))
                {
                    $ta->right = true;
                }else{
                    $ta->right = false;
                }
                $ta->save();
            }
        }
        return back()->with('success_question','Вопрос успешно добавлен!');
    }

    public function edit_question(Test $test, TestQuestion $question )
    {
        return view('admin.tests.edit_question',compact('test','question'));
    }

    public function update_question(Test $test, TestQuestion $question, Request $request)
    {
        $tq = TestQuestion::findOrFail($question->id);
        $tq->name = $request->edit_name;
        $tq->type_id = $request->edit_type;
        $tq->save();
        foreach ($request->c_t as $key => $value) 
        {
            $ta = TestAnswer::findOrFail($key);
            $ta->name = $value;
            if (isset($request->c_r[$key]))
                {
                    $ta->right = true;
                }else{
                    $ta->right = false;
                }
        $ta->save();
        }
        return back()->with('success_question','Вопрос успешно обновлен!');
    }

    public function delete_question(Test $test,TestQuestion $question)
    {
        
        $question->delete();
        $n = 1;
        foreach ($test->questions as $q)
        {
            $q->sort = $n;
            $q->save();
            $n++;
        }
        return back()->with('success_question','Вопрос теста успешно удален!');
    }

    public function move_down_question(Test $test, $sq)
    {
        $sq = TestQuestion::findOrFail($sq);
        $downer = TestQuestion::where([
    		['sort','=',$sq->sort+1],
    		['test_id','=',$test->id],
        ])->first();
    	$downer->sort = $downer->sort - 1;
    	$downer->save();
    	$sq->sort = $sq->sort + 1;
    	$downer->save();
    	$sq->save();
        return back()->with('success_question','Вопрос успешно перемещен!'); 
    }

    public function move_up_question(Test $test, $sq)
    {
        $sq = TestQuestion::findOrFail($sq);
        $upper = TestQuestion::where([
    		['sort','=',$sq->sort-1],
    		['test_id','=',$test->id],
        ])->first();
    	$upper->sort = $upper->sort + 1;
    	$upper->save();
    	$sq->sort = $sq->sort - 1;
    	$upper->save();
    	$sq->save();
    	return back()->with('success_question','Вопрос успешно перемещен!');
    }

}
