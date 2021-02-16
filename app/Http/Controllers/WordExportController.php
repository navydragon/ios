<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectStage;
use App\Event;
use App\Survey;
use App\SurveyAttempt;
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
}
