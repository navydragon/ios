<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\SurveyQuestion;
use App\User;
use App\TestAttempt;
use App\TestQuestion;
use App\Survey;
use App\Test;
use App\Task;
use App\Webinar;
use App\LearningModule;
use App\LearningCase;
use App\ProjectStage;


class AdminModalController extends Controller
{
    public function survey_questions(Event $event, SurveyQuestion $question)
    {
    	return view('admin.projects.stages.modals.survey_questions',compact('event','question'));
    }

    public function survey_users(Event $event, User $user)
    {
    	return view('admin.projects.stages.modals.survey_users',compact('event','user'));
    }

     public function test_users($testattempt)
    {
    	$ta = TestAttempt::findOrFail($testattempt);
    	return view('admin.projects.stages.modals.test_users',compact('ta'));
    }

    public function test_questions(Event $event, TestQuestion $question)
    {
    	
    	$ta = DB::table('test_attempts')->where('test_attempts.event_id', $event->id)->get();
    	return view('admin.projects.stages.modals.test_questions',compact('event','question','ta'));
    }

    public function view_possible_events($ps)
    {

        $ps = ProjectStage::findOrFail($ps);
        $surveys = Survey::all();
        $tests = Test::all();
        $tasks = Task::all();
        $webinars = Webinar::all();
        $learning_modules = LearningModule::all();
        return view('admin.projects.stages.modals.view_possible_events',compact('surveys','tests','tasks','webinars','learning_modules','ps'));
    }

    public function view_possible_tests($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $tests = Test::with('author:id,filial_id')->withCount('questions')->get();
        return view('admin.projects.stages.modals.view_possible_tests',compact('tests','ps'));
    }

    public function view_possible_surveys($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $surveys = Survey::with('author:id,filial_id')->withCount('questions')->get();
        return view('admin.projects.stages.modals.view_possible_surveys',compact('surveys','ps'));
    }

    public function view_possible_tasks($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $tasks = Task::with('author:id,filial_id')->get();
        return view('admin.projects.stages.modals.view_possible_tasks',compact('tasks','ps'));
    }

    public function view_possible_materials($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $materials = LearningModule::with('author:id,filial_id')->get();
        return view('admin.projects.stages.modals.view_possible_materials',compact('materials','ps'));
    }

    public function view_possible_cases($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $cases = LearningCase::with('author:id,filial_id')->get();
        return view('admin.projects.stages.modals.view_possible_cases',compact('cases','ps'));
    }

    public function view_possible_webinars($ps)
    {
        $ps = ProjectStage::findOrFail($ps);
        $webinars = Webinar::with('author:id,filial_id')->get();
        return view('admin.projects.stages.modals.view_possible_webinars',compact('webinars','ps'));
    }

    public function edit_question(Test $test, TestQuestion $question)
    {
        return view('admin.projects.stages.modals.edit_question',compact('test','question'));
    }
}
