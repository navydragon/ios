<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Survey;
use App\SurveyQuestion;
use App\Event;
class AdminSurveyController extends Controller
{
    public function index()
    {
    	$surveys = Survey::all();
    	return view('admin.surveys.index',compact('surveys'));
    }

    public function store(Request $request)
    {
    	$survey = new Survey;
    	$survey->name = $request->name;
    	$survey->author_id = Auth::user()->id;
    	if($request->description)
    	{
    		$survey->description = $request->description;	
    	}else
    	{
    		$survey->description = ' ';
    	}
    	
    	$survey->save();
    	return redirect('/adm/surveys/'.$survey->id.'/edit');
    }

    public function show(Survey $survey)
    {
        $questions = $survey->questions()->orderBy('sort')->get();
    	return view('admin.surveys.show',compact('survey','questions'));
    }
    public function edit(Survey $survey)
    {
        // $n = 1;
        // foreach($survey->questions as $question)
        // {
        //     $q = SurveyQuestion::find($question->id);
        //     if ($q->sort == null) { $q->sort = $n;}
        //     $q->save();
        //     $n++;
        // }
        $questions = $survey->questions()->orderBy('sort')->get();
        return view('admin.surveys.edit',compact('survey','questions'));
    }

    public function update(Survey $survey, Request $request)
    {
       $survey->name = $request->name;
       if ($request->description)
       {
        $survey->description = $request->description;
       }else{
        $survey->description = " ";
       }
       $survey->save();
       $questions = $survey->questions()->orderBy('sort')->get();
       return redirect('/adm/surveys/'.$survey->id.'/edit')->with('success','Данные успещно обновлены!');
    }
    public function store_question(Survey $survey, Request $request)
    {
    	$surv= Survey::findOrFail($survey);
    	$sq = new SurveyQuestion;
    	$sq->survey_id = $survey->id;
        $sq->body = $request->body;
        $sq->sort = SurveyQuestion::where('survey_id','=',$survey->id)->get()->count()+1;
    	$sq->save();
    	return back()->with('success_question','Вопрос успешно добавлен!'); ;
    }

    public function edit_question(Survey $survey, SurveyQuestion $question )
    {
        return view('admin.surveys.edit_question',compact('survey','question'));
    }

    public function update_question(Survey $survey, SurveyQuestion $question, Request $request)
    {
        $question->body = $request->body;
        $question->save();
        return back()->with('success_question','Вопрос успешно обновлен!'); ;
    }

    public function delete_question(Survey $survey,SurveyQuestion $question)
    {
        
        $question->delete();
        $n = 1;
        foreach ($survey->questions as $q)
        {
            $q->sort = $n;
            $q->save();
            $n++;
        }
        return back()->with('success_question','Вопрос анкеты успешно удален!');
    }

    public function delete(Survey $survey)
    {
        $events = Event::where('event_type_id','=',1)->where('source_id','=',$survey->id)->get();
        foreach ($events as $event) { $event->delete();}
        $survey->delete();
        return back()->with('success_delete','Анкета успешно удалена!');
    }

    public function move_up_question(Survey $survey, $sq)
    {
        $sq = SurveyQuestion::findOrFail($sq);
        $upper = SurveyQuestion::where([
    		['sort','=',$sq->sort-1],
    		['survey_id','=',$survey->id],
        ])->first();
    	$upper->sort = $upper->sort + 1;
    	$upper->save();
    	$sq->sort = $sq->sort - 1;
    	$upper->save();
    	$sq->save();
    	return back()->with('success_question','Вопрос успешно перемещен!');
    }

    public function move_down_question(Survey $survey, $sq)
    {
        $sq = SurveyQuestion::findOrFail($sq);
        $downer = SurveyQuestion::where([
    		['sort','=',$sq->sort+1],
    		['survey_id','=',$survey->id],
        ])->first();
    	$downer->sort = $downer->sort - 1;
    	$downer->save();
    	$sq->sort = $sq->sort + 1;
    	$downer->save();
    	$sq->save();
        return back()->with('success_question','Вопрос успешно перемещен!'); 
    }
}
