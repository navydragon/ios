<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectStage;
use App\Event;
use App\EventResult;
use App\Survey;
use App\SurveyAttempt;
use App\Test;
use App\User;
use App\LearningCase;
use App\TestQuestion;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
class WordExportController extends Controller
{
    public function assessment_template(Project $project,Event $event)
    {
    	$doc = new \PhpOffice\PhpWord\PhpWord();
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

    	$section = $doc->addSection(['orientation' => 'landscape']);
    	$section->addText($project->name,'bold');
    	$section->addText('Оценка мероприятия "'.$event->description()->name.'"','bold');
    	$section->addText('экспертом _____________________________________','common');

    	$table = $section->addTable('myTable');
    	$table->addRow();
    	$table->addCell(500)->addText("№",'bold');
    	$table->addCell(4000)->addText("ФИО участников",'bold');

    	foreach ($event->criterias as $criteria)
    	{
    		$table->addCell(4000)->addText($criteria->name,'bold');
    	}
    	$table->addCell(4000)->addText('Общая оценка','bold');
    	$n = 0;
    	foreach ($project->members as $member)
    	{
    		$n++;
    		$table->addRow();
    		$table->addCell(500)->addText($n,'common');
    		$table->addCell(4000)->addText($member->name,'common');
    		foreach ($event->criterias as $criteria)
	    	{
	    		$table->addCell(4000)->addText(' ','common');
	    	}
	    	$table->addCell(4000)->addText(' ','common');
    	}

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path('Шаблон_оценки.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path('Шаблон_оценки.docx'));
    }

    public function survey(SurveyAttempt $attempt)
    {
    	$doc = new \PhpOffice\PhpWord\PhpWord();
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

		$section = $doc->addSection();
		$section->addText($attempt->survey->name,'bold');
    	$section->addText('Заполнил: '.$attempt->user->name,'common');
    	$section->addText('Дата заполнения: '.Carbon::parse($attempt->created_at)->format('d.m.Y'),'common');

    	$table = $section->addTable('myTable');
    	$table->addRow();
    	$table->addCell(500)->addText("№",'bold');
    	$table->addCell(4000)->addText("Вопрос",'bold');
    	$table->addCell(4000)->addText("Ответ",'bold');
    	$n = 0;
    	foreach ($attempt->answers as $answer)
    	{
    		$n++;
    		$table->addRow();
	    	$table->addCell(500)->addText($n.'.','common');
	    	$table->addCell(4000)->addText($answer->question->body,'common');
	    	$table->addCell(4000)->addText($answer->answer_text,'common');
    	}

    	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path($attempt->survey->name.'_'.$attempt->user->name.'.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path($attempt->survey->name.'_'.$attempt->user->name.'.docx'));
    }

    public function test(Event $event, User $user)
    {
        $ep = $event->event_parameter;
        $er = EventResult::where('event_id','=',$event->id)->where('user_id','=',$user->id)->get()->first();
        $test = Test::findOrFail($event->source_id);
        $attempt = $test->user_attempts($user->id,$event->id)->latest()->get()->first();

    	$doc = new \PhpOffice\PhpWord\PhpWord();
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

		$section = $doc->addSection();
		$section->addText($attempt->test->name,'bold');
    	$section->addText('Участник: '.$attempt->user->name,'common');
    	$section->addText('Дата и время начала попытки: '.Carbon::parse($attempt->created_at)->format('d.m.Y H:i:s'),'common');
        $section->addText('Дата и время завершения попытки: '.Carbon::parse($attempt->updated_at)->format('d.m.Y H:i:s'),'common');
        if ($attempt->result == true) {$result = 'Пройдено';}else{$result = 'Не пройдено';}
        $section->addText('Результат: '.$result,'common');
        $section->addText('Набрано баллов: '.$attempt->score.' / '.$ep->show_questions,'common');
        $section->addText('Ответы в последней попытке:','bold');
        $n = 1;
        $qsta = $attempt->attempt_results()->select('question_id')->distinct()->get();
        $qs = [];
        foreach ($qsta as $q)
        {
            array_push($qs,$q->question);
        }
        foreach($qs as $question)
        {
            $res = $question->is_right($attempt->id) == true ? "Верно" : "Неверно";
            $section->addText($question->name.'('.$res .')','bold');
            foreach ($question->answers as $answer)
            {
                if ($answer->is_chosen($attempt->id)){$style='bold';}else{$style='common';}
                $section->addText('- '.$answer->name,$style);
            }
        }
       
    	

    	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path($attempt->test->name.'_'.$attempt->user->name.'.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path($attempt->test->name.'_'.$attempt->user->name.'.docx'));
    }

    public function case(Event $event, User $user)
    {
        $ep = $event->event_parameter;
        $er = EventResult::where('event_id','=',$event->id)->where('user_id','=',$user->id)->get()->first();
        $case = LearningCase::findOrFail($event->source_id);
        

    	$doc = new \PhpOffice\PhpWord\PhpWord();
        $doc->setDefaultFontName('Times New Roman');
        $doc->setDefaultFontSize(14);
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

		$section = $doc->addSection();
		$section->addText($case->name,'bold');
    	$section->addText('Участник: '.$user->name,'common');
    	$section->addText('Дата и время последнего обновления ответов на кейс: '.Carbon::parse($er->last_activity)->format('d.m.Y H:i:s'),'common');
       
        $case_tasks = $case->tasks; 
        $case_results = $case->results($event->id,$user->id);
        foreach($case_tasks as $task)
        {
            $uct = $task->user_answer($user->id,$event->id); 
            $section->addText('Задание № '.$task->sort,'bold');
            if (count($uct) > 0)
            {
                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $uct->first()->pivot->answer, false, false);
            }
        }
        //dd($case_results->first()->possible_errors);
        $section->addText('Возможные ошибки','bold');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, count($case_results) > 0 ? $case_results->first()->possible_errors : '', false, false);
         $section->addText('Последствия ошибок','bold');
         \PhpOffice\PhpWord\Shared\Html::addHtml($section, count($case_results) > 0 ? $case_results->first()->error_effects : '', false, false);
         $section->addText('Алгоритмы','bold');
         \PhpOffice\PhpWord\Shared\Html::addHtml($section, count($case_results) > 0 ? $case_results->first()->algorithms : '', false, false);
         $section->addText('Выводы','bold');
         \PhpOffice\PhpWord\Shared\Html::addHtml($section, count($case_results) > 0 ? $case_results->first()->conclusions : '', false, false);

    	

    	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path($case->name.'_'.$user->name.'.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path($case->name.'_'.$user->name.'.docx'));
    }

    public function event(Event $event)
    {
        $e_d = $event->description();

    	$doc = new \PhpOffice\PhpWord\PhpWord();
        $doc->setDefaultFontName('Times New Roman');
        $doc->setDefaultFontSize(14);
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

		$section = $doc->addSection();
        $section->addText($e_d->name,'bold');
        if ($event->is_local == true)
        {
            $section->addText('Локальное мероприятие ('.$e_d->type.'), дата завершения: '.\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y'),'bold');
        }else{
            $section->addText('Мероприятие в этапе «'.$event->stage->name.'», дата завершения: '.\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y'),'bold');
           
        }
		$section->addText('Участвовавшие пользователи:','common');
        $table = $section->addTable('myTable');
    	$table->addRow();
    	$table->addCell(4000)->addText("Пользователь",'bold');
    	$table->addCell(4000)->addText("Результат",'bold');
    	$table->addCell(4000)->addText("Дата последней активности",'bold');
    	$n = 0;
    	foreach ($event->event_results as $result)
    	{
    		$n++;
    		$table->addRow();
	    	$table->addCell(4000)->addText($result->user->name,'common');
	    	$table->addCell(4000)->addText($result->is_passed == 1 ? "пройден": "",'common');
	    	$table->addCell(4000)->addText(\Carbon\Carbon::createFromTimeStamp(strtotime($result->last_activity))->format('d.m.y H:i:s'),'common');
    	}
    	

    	

    	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path($e_d->name.'.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path($e_d->name.'.docx'));
    }

    public function stage(ProjectStage $stage)
    {
        

    	$doc = new \PhpOffice\PhpWord\PhpWord();
        $doc->setDefaultFontName('Times New Roman');
        $doc->setDefaultFontSize(14);
		$doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
		$doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
		$tableStyle = array(
		    'borderColor' => '000000',
		    'borderSize'  => 1,
		    'cellMargin'  => 10,
		    'layout' => 'autofit'
		);
		$firstRowStyle = array('bgColor' => 'FFFFFF');
		$doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

		$section = $doc->addSection();
        $section->addText('Этап: '.$stage->name.' '.\Carbon\Carbon::createFromTimeStamp(strtotime($stage->start_date))->format('d.m.Y').' - '.\Carbon\Carbon::createFromTimeStamp(strtotime($stage->end_date))->format('d.m.Y'),'bold');
        
        //$e_d = $event->description();
		
        $table = $section->addTable('myTable');
    	$table->addRow();
    	$table->addCell(4000)->addText("Мероприятие",'bold');
    	$table->addCell(4000)->addText("Тип",'bold');
    	$table->addCell(4000)->addText("Участвовало пользователей",'bold');
    	$n = 0;
    	 foreach ($stage->events as $event)
    	{
    		$n++;
            $e_d = $event->description();
    		$table->addRow();
	    	$table->addCell(4000)->addText($e_d->name,'common');
	    	$table->addCell(4000)->addText($e_d->type,'common');
	    	$table->addCell(4000)->addText($event->event_results()->count(),'common');
    	}
    	

    	

    	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
        	$objWriter->save(storage_path($stage->name.'.docx'));
        } catch (Exception $e) {	
        }

        return response()->download(storage_path($stage->name.'.docx'));
    }

    public function live_event_schedule(ProjectStage $stage, $date)
    {
        $date = Carbon::createFromFormat("d.m.Y", $date)->format('Y-m-d');;
        $doc = new \PhpOffice\PhpWord\PhpWord();
        $doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000'));
        $doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
        $tableStyle = array(
            'borderColor' => '000000',
            'borderSize'  => 1,
            'cellMargin'  => 100,
            'width' => 100,
            'layout' => 'autofit'
        );
        $firstRowStyle = array('bgColor' => 'FFFFFF');
        $doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

        $section = $doc->addSection();
        $section->addText($stage->project->name,'bold');
        $section->addText($stage->name,'bold');
        $section->addText('Расписание '.Carbon::parse($stage->date)->format('d.m.Y'),'common');
        $table = $section->addTable('myTable');
        $table->addRow();
        $table->addCell(500)->addText("Время",'bold');
        $table->addCell(4000)->addText("Мероприятие",'bold');
        $table->addCell(4000)->addText("Ответственный",'bold');
        $table->addCell(4000)->addText("Примечание",'bold');

         $events = DB::table('live_events')->where([
            ['stage_id','=',$stage->id],
            ['date','=',$date]
        ])->orderBy('start_time')->get();
        foreach ($events as $event)
        {
            $table->addRow();
            $table->addCell(500)->addText(Carbon::parse($event->start_time)->format('H:i').'-'.Carbon::parse($event->end_time)->format('H:i'),'common');
            $table->addCell(7000)->addText($event->name,'common');
            $table->addCell(3500)->addText($event->responsible,'common');
            $table->addCell(3500)->addText($event->note,'common');
        }
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
            $objWriter->save(storage_path(Carbon::parse($stage->date)->format('d.m.Y').'_расписание.docx'));
        } catch (Exception $e) {    
        }

        return response()->download(storage_path(Carbon::parse($stage->date)->format('d.m.Y').'_расписание.docx'));
    }

    public function users_in_project(Project $project)
    {
        $doc = new \PhpOffice\PhpWord\PhpWord();
        $doc->addFontStyle( 'common',array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000'));
        $doc->addFontStyle( 'bold',array('name' => 'Times New Roman', 'size' => 14, 'color' => '000000','bold' => true));
        $tableStyle = array(
            'borderColor' => '000000',
            'borderSize'  => 1,
            'cellMargin'  => 100,
            'width' => 100,
            'layout' => 'autofit'
        ); 
        $firstRowStyle = array('bgColor' => 'FFFFFF');
        $doc->addTableStyle('myTable', $tableStyle, $firstRowStyle);

        $section = $doc->addSection();
        $section->addText('Список участников оценочной сессии '.$project->name,'common');
        $table = $section->addTable('myTable');
        $table->addRow();
        $table->addCell(4000)->addText("Ф.И.О.",'bold');
        $table->addCell(4000)->addText("Филиал, подразделение",'bold');
        $table->addCell(4000)->addText("Должность",'bold');
        $table->addCell(4000)->addText("Контакты",'bold');
        $table->addCell(4000)->addText("Роль",'bold');
        foreach($project->users as $user )
        {
            
            $role = DB::table('project_roles')->where('id', $user->pivot->role_id)->first();
            $table->addRow();
            $table->addCell(4000)->addText($user->name,'common');
            $table->addCell(4000)->addText($user->filial->name.', '.$user->division,'common');
            $table->addCell(4000)->addText($user->job,'common');
            $table->addCell(4000)->addText($user->email.', '.$user->phone,'common');
            $table->addCell(4000)->addText($role->name,'common');
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($doc, 'Word2007');
        try {
            $objWriter->save(storage_path($project->id.'_расписание.docx'));
        } catch (Exception $e) {    
        }

        return response()->download(storage_path($project->id.'_расписание.docx'));
    }
}
