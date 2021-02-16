<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\ProjectRole;
use App\ProjectStage;
use App\Event;
use App\Survey;
use App\Test;
use App\Task;
use App\Webinar;
use App\LearningModule;
use App\Competence;
use App\EventAssessment;
use App\EventCompetenceAssessment;
use App\EventCriteria;
use App\EventCriteriaAssessment;
use App\User;
use App\LiveEvent;
use Carbon\Carbon;
use App\EventParameter;

class AdminProjectController extends Controller
{
    public function index()
    {
    	$projects = Project::with('p_status')->get();
    	return view('admin.projects.index',compact('projects'));
    }

    public function store(Request $request)
    {
    	$project = new Project;
    	$project->name = $request->name;
        $project->author_id = Auth::user()->id;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = 1;
    	if($request->description)
    	{
    		$project->description = $request->description;	
    	}else
    	{
    		$project->description = ' ';
        }
        
        $project->type = $request->type;
        $project->location = $request->location ? $request->location : " ";
    	
    	$project->save();
    	return redirect('/adm/projects/'.$project->id);
    }

    public function show(Project $project)
    {
        $competences = Competence::all();
        $roles = ProjectRole::all();
        return view('admin.projects.show',compact('project','competences','roles'));
    }

    public function update(Project $project, Request $request)
    {
        $project->name = $request->name;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->type = $request->type;
        $project->location = $request->location ? $request->location : " ";
        $project->save();
        return back()->with('success_project','Данные оценочной сесии обновлены!');
    }

    public function delete(Project $project)
    {
        $project->delete();
        return back()->with('success_delete','Оценочная сессия удалена!');
    }

    public function stage_store(Project $project,Request $request)
    {
        $stage = new ProjectStage;
        $stage->project_id = $project->id;
        $stage->name = $request->name;
        $stage->start_date = $request->startdate;
        $stage->end_date = $request->enddate;
        $stage->description = $request->description;
        $stage->type = $request->type;
        $stage->sort = 1;
        $stage->save();
        return back()->with('success_stage','Этап успешно добавлен!');
    }

    public function stage_edit(Project $project, ProjectStage $project_stage)
    {
        $project = Project::findOrFail($project->id);
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        $desc = urlencode($project_stage->description);
        $surveys = Survey::all();        
        $tasks = Task::all();   
        $tests = Test::all();   
        $webinars = Webinar::all();   
        $learning_modules = LearningModule::all(); 
        $events = $project_stage->events();

        $start = Carbon::createFromFormat('Y-m-d',$project_stage->start_date);
        $end = Carbon::createFromFormat('Y-m-d', $project_stage->end_date);
        $diff_in_days = $start->diffInDays($end);
        if ($diff_in_days > 3)
        {
            return view('admin.projects.stages.edit',compact('project_stage','project','desc'));
        }
            $days = []; 
            for ($i = 0; $i <= $diff_in_days; $i++)
            {
               $date = $start->copy()->addDays($i);
               $date = $date->format('d.m.Y');
                array_push ($days, $date );
            }
            return view('admin.projects.stages.edit_och',compact('project_stage','project','desc','days'));
    }

    public function stage_update(Project $project, ProjectStage $project_stage, Request $request)
    {
        $project_stage->name = $request->name;
        $project_stage->type = $request->type;
        $project_stage->description = $request->description;
        $project_stage->start_date = $request->startdate;
        $project_stage->end_date = $request->enddate;
        $project_stage->save();
        return back();
    }
    
    public function add_event_to_stage (ProjectStage $project_stage,Request $request)
    {
        switch (substr($request->radio, 0,2)) {
            case 'su': $e_t = 1; break;
            case 'te': $e_t = 3; break;
            case 'ta': $e_t = 5; break;
            case 'lm': $e_t = 2; break;
            case 'we': $e_t = 4; break;
            default: return back(); break;
        }
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = substr($request->radio,2);

        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;
        $event->save();
        return back();
    }

    public function add_test_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 3;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->test_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->show_questions = $request->show_questions;
        $e_p->passing_score = $request->passing_score;
        $e_p->max_attempts = $request->max_attempts;
        $e_p->attempt_time = $request->attempt_time;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_survey_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 1;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->test_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_task_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 5;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->task_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_material_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 2;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->material_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_case_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 6;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->case_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }

    public function add_webinar_to_stage (ProjectStage $project_stage,Request $request)
    {
        $e_t = 4;
        $event = new Event; 
        $event->project_stage_id = $project_stage->id;
        $event->event_type_id = $e_t;
        $event->source_id = $request->webinar_id;
        $event->sort = Event::where('project_stage_id','=',$project_stage->id)->get()->count()+1;

        $e_p = new EventParameter;
        $e_p->max_date = $request->max_date;
        $e_p->save();

        $event->event_parameter_id = $e_p->id;
        $event->save();
        return back();
    }


    public function stage_analysis(Project $project, ProjectStage $project_stage)
    {
        $project = Project::findOrFail($project->id);
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        return view('admin.projects.stages.analysis',compact('project','project_stage'));
    }

    public function user_analysis(Project $project, User $user)
    {
       return view('admin.projects.users.analysis',compact('project','user'));
    }

    public function user_decline (Project $project, User $user)
    {
        $project->users()->detach($user->id);
        return back()->with('success_user','Пользователь успешно отключен от сессии!');
    }

    public function event_analysis(Project $project, ProjectStage $project_stage, Event $event)
    {
        $project = Project::findOrFail($project->id);
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        $event = Event::findOrFail($event->id);
        switch ($event->event_type_id) {
            case 1:
                $survey = Survey::findOrFail($event->source_id);
                return view('admin.projects.stages.event_analysis_survey',compact('project_stage','event','survey'));
            break;

            case 3:
                $test = Test::findOrFail($event->source_id);
                 return view('admin.projects.stages.event_analysis_test',compact('project_stage','event','test'));
            break;

            case 5:
                $task = Task::findOrFail($event->source_id);
                 return view('admin.projects.stages.event_analysis_task',compact('project','project_stage','event','task'));
            break;
            
            default:
                dd('Ошибка');
                break;
        }
    }

    public function event_assessment(Project $project, ProjectStage $project_stage, Event $event)
    {
        $project = Project::findOrFail($project->id);
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        $event = Event::findOrFail($event->id);
        return view('admin.projects.stages.event_assessment',compact('project','project_stage','event'));
    }

    public function change_competence_assess(Project $project, Request $request)
    {
        $project = Project::findOrFail($project->id);
        $project->competence_assessment = $request->value;
        $project->save();
        return back();
    }

    public function change_competences(Project $project, Request $request)
    {
        $project = Project::findOrFail($project->id);
        $project->competences()->sync($request->value);
        return back();
    }



    public function update_stage_name(ProjectStage $project_stage, Request $request)
    {
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        $project_stage->name = $request->value;
        $project_stage->save();
        return back();
    }
    public function update_stage_desc(ProjectStage $project_stage, Request $request)
    {
        $project_stage = ProjectStage::findOrFail($project_stage->id);
        $project_stage->description = $request->value;
        $project_stage->save();
        return back();
    }

    public function update_event_assessment(Event $event, Request $request)
    {
        $event = Event::findOrFail($event->id);
        $event->assessment = $request->value;
        $event->save();
        return back();
    }

    public function update_event_competences(Event $event, Request $request)
    {
        $event = Event::findOrFail($event->id);
        $event->competences()->sync($request->value);
        return back();
    }

    public function update_user_role(Project $project, Request $request)
    {
        $project = Project::findOrFail($project->id);
        $project->users()->updateExistingPivot ($request->pk,['role_id' => $request->value]);
    }

    public function user_event_asses(Event $event, Request $request)
    {
        
        $event = Event::findOrFail($event->id);
        $user = User::findOrFail($request->pk);

        $ea = EventAssessment::firstOrCreate(['event_id' => $event->id,'user_id' => $request->pk,'expert_id' => Auth()->user()->id]);
        $ea->mark = $request->value;
        $ea->save();
        return back();
    }

    public function user_event_competence_asses(Event $event, Request $request)
    {
        $event = Event::findOrFail($event->id);
        $competence = Competence::findOrFail($request->name);
        $user = User::findOrFail($request->pk);

        $eca = EventCompetenceAssessment::firstOrCreate(['event_id' => $event->id,'user_id' => $request->pk,'expert_id' => Auth()->user()->id,'competence_id' => $competence->id ]);
        $eca->mark = $request->value;
        $eca->save();
        return back();
    }

    public function user_event_criteria_asses(Event $event, Request $request)
    {
        $event = Event::findOrFail($event->id);
        $criteria = EventCriteria::findOrFail($request->name);
        $user = User::findOrFail($request->pk);
        $eca = EventCriteriaAssessment::firstOrCreate(['event_id' => $event->id,'user_id' => $request->pk,'expert_id' => Auth()->user()->id,'criteria_id' => $criteria->id ]);
        $eca->mark = $request->value;
        $eca->save();
        return back();
    }

    public function add_criteria_to_event(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $ec = new EventCriteria;
        $ec->name = $request->name;
        $ec->event_id = $event->id;
        $ec->save();
        return back();
    }

    public function add_och_event(ProjectStage $project_stage, Request $request)
    {
        $event = new LiveEvent;
        $event->stage_id = $project_stage->id;
        $event->date = Carbon::createFromFormat("d.m.Y", $request->date);
        $event->start_time = $request->start_time;
        $event->name = $request->name;
        $event->end_time = $request->end_time;
        $event->responsible = $request->responsible;
        $event->note =$request->note;
        $event->save();
        return back();
    }

    function stage_delete(Project $project, ProjectStage $project_stage)
    {
        $project_stage->delete();
        return back()->with('stage_success','Этап удален!');
    }

}
