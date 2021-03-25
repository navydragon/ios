<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::group(['middleware' => 'auth'], function(){
Route::get('/main', 'HomeController@index');
Route::get('/knowledge_base', 'HomeController@knbase');
Route::get('/contacts', 'HomeController@contacts');
Route::get('/knowledge_base/{category}', 'HomeController@knbase_category');
Route::get('/knowledge_base/materials/{material}', 'HomeController@knbase_material');
Route::post('/knowledge_base/materials/{material}/add_comment','KnbaseController@add_comment');
Route::post('/knowledge_base/{category}/add_material','KnbaseController@add_material');
Route::get('/home', 'HomeController@index');
 
Route::get('/recommended_cases', 'HomeController@recommended_cases');
Route::get('/recommended_cases/{case}', 'HomeController@show_case');
Route::get('/recommended_modules', 'HomeController@recommended_modules');

Route::get('/user_settings', 'UserController@user_settings');
Route::get('/user_projects', 'UserController@user_projects');
Route::get('/user_local', 'UserController@user_local');
Route::get('/user_dialogs', 'UserController@user_dialogs');
Route::get('/user_dialogs/{dialog}', 'UserController@show_user_dialog');
Route::post('/user_dialogs/{dialog}/add_message', 'DialogController@add_message');
Route::post('/add_dialog', 'UserController@add_dialog');
Route::post('/user_avatar', 'UserController@update_avatar');
Route::post('/change_password', 'UserController@change_password');
Route::post('/update_personal_info', 'UserController@update_personal_info');
Route::get('/delete_avatar', 'UserController@delete_avatar');


Route::get('/local_events', 'EventController@local_events_index');
Route::get('/local_events/completed', 'EventController@local_events_completed');

Route::get('/projects', 'ProjectController@index')->name('project_index');
Route::get('/projects/completed', 'ProjectController@index_completed');
Route::get('/projects/{project}', 'ProjectController@show')->name('project_show');
Route::get('/projects/{project}/show_results', 'ProjectController@show_project_results');

Route::get('/projects/{project}/add_user/{user}', 'ProjectController@add_user_to_project')->name('add_user_to_project');
//Route::get('/projects/{project}/events/{event}/surveys/{survey}', 'SurveyController@pr_show')->name('show_survey');
Route::post('/events/{event}/surveys/{survey}', 'SurveyController@store_results');
//Route::get('/projects/{project}/events/{event}/tests/{test}', 'TestController@show')->name('show_test');
Route::get('/events/{event}/tests/{test}/new_attempt', 'TestController@new_attempt');
Route::get('/events/{event}/tests/attempts/{attempt}', 'TestAttemptController@show_attempt');
Route::post('/events/{event}/tests/attempts/{attempt}/summary', 'TestAttemptController@show_summary');
Route::post('/events/{event}/tests/attempts/{attempt}/save', 'TestAttemptController@save_attempt');
Route::get('/events/{event}/tests/attempts/{attempt}/review', 'TestAttemptController@review_attempt');

Route::get('/projects/{project}/events/{event}/tasks/{task}', 'TaskController@show')->name('show_task');
Route::post('/events/{event}/tasks/{task}/store_user_file', 'EventUserFileController@store');

//Route::get('events/{event}/cases/{case}', 'CaseController@show');
Route::post('/projects/{project}/events/{event}/cases/{case}/store_user_file', 'EventUserFileController@store');
Route::post('/events/{event}/cases/{case}/tasks/{task}','CaseController@store_task_answer');
Route::post('/events/{event}/cases/{case}/store_answer/{type}','CaseController@store_case_answer');


Route::get('/projects/{project}/events/{event}/webinars/{webinar}', 'WebinarController@show_in_project');

//Route::get('/projects/{project}/events/{event}/learning_modules/{learning_module}', 'LearningModuleController@pr_show')->name('show_survey');

Route::post('/events/{event}/add_comment','EventController@add_comment');
Route::get('/events/{event}','EventController@show_event');


Route::get('/forums', 'ForumController@index');
Route::post('/forums', 'ForumController@store');
Route::get('/forums/{forum}', 'ForumController@show');

Route::get('/webinars', 'WebinarController@index');
Route::get('/webinars/{webinar}', 'WebinarController@show');
Route::get('/webinars/{webinar}/go', 'WebinarController@go');
Route::get('/webinars/{webinar}/view', 'WebinarController@view');

Route::get('/forums/{forum}/threads/{thread}', 'ForumController@show_thread');
Route::post('/forums/{forum}/threads', 'ForumController@store_thread');

Route::post('/forums/{forum}/threads/{thread}', 'ForumController@store_message');
});

// Admin
Route::group(['middleware' => 'is_admin'], function(){

Route::get('/adm', 'AdminController@index');
Route::get('/adm/projects', 'AdminProjectController@index');
Route::post('/adm/projects', 'AdminProjectController@store');
Route::get('/adm/projects/{project}', 'AdminProjectController@show');
Route::post('/adm/projects/{project}', 'AdminProjectController@update');
Route::delete('/adm/projects/{project}', 'AdminProjectController@delete');

Route::get('/adm/local_events', 'AdminEventController@index');
Route::get('/adm/local_events/view_possible_tests', 'AdminEventController@view_possible_tests');
Route::get('/adm/local_events/view_possible_surveys', 'AdminEventController@view_possible_surveys');
Route::get('/adm/local_events/view_possible_materials', 'AdminEventController@view_possible_materials');
Route::get('/adm/local_events/view_possible_tasks', 'AdminEventController@view_possible_tasks');
Route::get('/adm/local_events/view_possible_cases', 'AdminEventController@view_possible_cases');
Route::get('/adm/local_events/view_possible_webinars', 'AdminEventController@view_possible_webinars');
Route::post('/adm/local_events/add_test', 'AdminEventController@add_test');
Route::post('/adm/local_events/add_survey', 'AdminEventController@add_survey');
Route::post('/adm/local_events/add_material', 'AdminEventController@add_material');
Route::post('/adm/local_events/add_task', 'AdminEventController@add_task');
Route::post('/adm/local_events/add_case', 'AdminEventController@add_case');
Route::post('/adm/local_events/add_webinar', 'AdminEventController@add_webinar');


Route::get('/adm/local_events/{event}','AdminEventController@show_local_event');
Route::get('/adm/local_events/{event}/edit','AdminEventController@edit_local_event');
Route::post('/adm/local_events/{event}','AdminEventController@update_local_event');
Route::delete('/adm/local_events/{event}','AdminEventController@delete_local_event');

Route::post('/adm/projects/{project}/stages', 'AdminProjectController@stage_store')->name('admin_projectstages_store');
Route::get('/adm/projects/{project}/stages/{project_stage}/edit', 'AdminProjectController@stage_edit');
Route::post('/adm/projects/{project}/stages/{project_stage}/', 'AdminProjectController@stage_update');

Route::post('/adm/projects/stages/{project_stage}/add_och_event', 'AdminProjectController@add_och_event');

Route::get('/adm/projects/{project}/stages/{project_stage}/analysis', 'AdminProjectController@stage_analysis');
Route::delete('/adm/projects/{project}/stages/{project_stage}','AdminProjectController@stage_delete');

Route::get('/adm/projects/{project}/users/{user}/analysis', 'AdminProjectController@user_analysis');
Route::delete('/adm/projects/{project}/users/{user}', 'AdminProjectController@user_decline');

Route::get('/adm/projects/{project}/stages/{project_stage}/analysis/events/{event}', 'AdminProjectController@event_analysis');

Route::get('/adm/projects/{project}/stages/{project_stage}/events/{event}/assess', 'AdminProjectController@event_assessment');

Route::post('/adm/projects/{project}/change_competence_assess', 'AdminProjectController@change_competence_assess');
Route::post('/adm/projects/{project}/change_competences', 'AdminProjectController@change_competences');
Route::post('/adm/projects/{project}/update_user_role', 'AdminProjectController@update_user_role');

Route::post('/adm/projects/events/{event}/update_event_assessment', 'AdminProjectController@update_event_assessment');
Route::post('/adm/projects/events/{event}/update_event_competences', 'AdminProjectController@update_event_competences');
Route::post('/adm/projects/events/{event}/assess', 'AdminProjectController@user_event_asses');
Route::post('/adm/projects/events/{event}/competence_assess', 'AdminProjectController@user_event_competence_asses');
Route::post('/adm/projects/events/{event}/criteria_assess', 'AdminProjectController@user_event_criteria_asses');
Route::post('/adm/projects/events/add_criteria', 'AdminProjectController@add_criteria_to_event');

	
Route::get('/adm/modal/events/{event}/survey_questions/{question}', 'AdminModalController@survey_questions');
Route::get('/adm/modal/events/{event}/survey_users/{user}', 'AdminModalController@survey_users');
Route::get('/adm/modal/events/tests/attempts/{attempt}/review', 'AdminModalController@test_users');
Route::get('/adm/modal/events/{event}/tests/questions/{question}/review', 'AdminModalController@test_questions');
Route::get('/adm/modal/events/{project_stage}/view_possible_events', 'AdminModalController@view_possible_events');

Route::get('/adm/events/{event}/results/{user}', 'AdminEventController@event_user_result');
Route::get('/events/{event}/results/{user}', 'AdminEventController@event_user_result');

Route::post('/adm/projects/stages/{project_stage}/add_event', 'AdminProjectController@add_event_to_stage');
Route::delete('/adm/projects/{project}/events/{event}','EventController@delete_event');

Route::get('/adm/modal/events/{project_stage}/view_possible_tests', 'AdminModalController@view_possible_tests');
Route::post('/adm/projects/stages/{project_stage}/add_test', 'AdminProjectController@add_test_to_stage');

Route::get('/adm/modal/events/{project_stage}/view_possible_surveys', 'AdminModalController@view_possible_surveys');
Route::post('/adm/projects/stages/{project_stage}/add_survey', 'AdminProjectController@add_survey_to_stage');

Route::get('/adm/modal/events/{project_stage}/view_possible_materials', 'AdminModalController@view_possible_materials');
Route::post('/adm/projects/stages/{project_stage}/add_material', 'AdminProjectController@add_material_to_stage');

Route::get('/adm/modal/events/{project_stage}/view_possible_tasks', 'AdminModalController@view_possible_tasks');
Route::post('/adm/projects/stages/{project_stage}/add_task', 'AdminProjectController@add_task_to_stage');

Route::get('/adm/modal/events/{project_stage}/view_possible_cases', 'AdminModalController@view_possible_cases');
Route::post('/adm/projects/stages/{project_stage}/add_case', 'AdminProjectController@add_case_to_stage');

Route::get('/adm/modal/events/{project_stage}/view_possible_webinars', 'AdminModalController@view_possible_webinars');
Route::post('/adm/projects/stages/{project_stage}/add_webinar', 'AdminProjectController@add_webinar_to_stage');

Route::get('/adm/surveys', 'AdminSurveyController@index');
Route::post('/adm/surveys', 'AdminSurveyController@store');
Route::get('/adm/surveys/{survey}', 'AdminSurveyController@show');
Route::get('/adm/surveys/{survey}/edit', 'AdminSurveyController@edit');
Route::post('/adm/surveys/{survey}', 'AdminSurveyController@update');
Route::delete('/adm/surveys/{survey}', 'AdminSurveyController@delete');
Route::post('/adm/surveys/{survey}/store_question', 'AdminSurveyController@store_question');
Route::get('/adm/surveys/{survey}/edit_question/{question}', 'AdminSurveyController@edit_question');
Route::post('/adm/surveys/{survey}/update_question/{question}', 'AdminSurveyController@update_question');
Route::delete('/adm/surveys/{survey}/questions/{question}', 'AdminSurveyController@delete_question');
Route::get('/adm/surveys/{survey}/questions/{question}/move_up', 'AdminSurveyController@move_up_question');
Route::get('/adm/surveys/{survey}/questions/{question}/move_down', 'AdminSurveyController@move_down_question');

Route::get('/adm/cases', 'AdminCaseController@index');
Route::post('/adm/cases', 'AdminCaseController@store');
Route::get('/adm/cases/{case}', 'AdminCaseController@show');
Route::get('/adm/cases/{case}/edit', 'AdminCaseController@edit');
Route::post('/adm/cases/{case}', 'AdminCaseController@update');
Route::delete('/adm/cases/{case}', 'AdminCaseController@delete');
Route::post('/adm/cases/{case}/add_file', 'AdminCaseController@add_file');
Route::post('/adm/cases/{case}/add_task', 'AdminCaseController@add_task');
Route::delete('/adm/cases/{case}/tasks/{task}','AdminCaseController@delete_task');
Route::delete('/adm/case_files/{case_file}/delete','AdminCaseController@delete_file');
Route::get('/adm/cases/{case}/tasks/{task}/move_up', 'AdminCaseController@move_up_task');
Route::get('/adm/cases/{case}/tasks/{task}/move_down', 'AdminCaseController@move_down_task');
Route::get('/adm/cases/{case}/edit_task/{task}', 'AdminCaseController@edit_task');
Route::post('/adm/cases/{case}/update_task/{task}', 'AdminCaseController@update_task');


Route::get('/adm/tests', 'AdminTestController@index');
Route::post('/adm/tests', 'AdminTestController@store');
Route::get('/adm/tests/{test}', 'AdminTestController@show');
Route::get('/adm/tests/{test}/edit', 'AdminTestController@edit');
Route::post('/adm/tests/{test}', 'AdminTestController@update');
Route::delete('/adm/tests/{test}', 'AdminTestController@destroy');
Route::post('/adm/tests/{test}/store_question', 'AdminTestController@store_question');
Route::get('/adm/tests/{test}/edit_question/{question}', 'AdminTestController@edit_question');
Route::post('/adm/tests/{test}/update_question/{question}', 'AdminTestController@update_question');
Route::get('/adm/modal/tests/{test}/questions/{question}/edit', 'AdminModalController@edit_question');
Route::delete('/adm/tests/{test}/questions/{question}', 'AdminTestController@delete_question');
Route::get('/adm/tests/{test}/questions/{question}/move_up', 'AdminTestController@move_up_question');
Route::get('/adm/tests/{test}/questions/{question}/move_down', 'AdminTestController@move_down_question');


Route::get('/adm/events/{event}/moveup', 'EventController@moveup');
Route::get('/adm/events/{event}/movedown', 'EventController@movedown');

Route::get('/adm/kn_base','KnbaseController@index');
Route::get('/adm/kn_base/{category}','KnbaseController@show_category');
Route::delete('/adm/kn_base/{category}','KnbaseController@delete_category');
Route::post('/adm/knbase_category','KnbaseController@add_category');

Route::post('/adm/knbase/{category}/add_material','KnbaseController@add_material');
Route::get('/adm/kn_base/materials/{material}','KnbaseController@show_material');
Route::get('/adm/kn_base/materials/{material}/edit','KnbaseController@edit_material');
Route::post('/adm/kn_base/materials/{material}/update','KnbaseController@update_material');

Route::delete('/adm/kn_base/materials/{material}','KnbaseController@delete_material');
Route::post('/adm/kn_base/materials/{material}/add_comment','KnbaseController@add_comment');

Route::get('/adm/tasks', 'AdminTaskController@index');
Route::post('/adm/tasks', 'AdminTaskController@store');
Route::get('/adm/tasks/{task}', 'AdminTaskController@show');
Route::get('/adm/tasks/{task}/edit', 'AdminTaskController@edit');
Route::post('/adm/tasks/{task}', 'AdminTaskController@update');
Route::post('/adm/tasks/{task}/add_file', 'AdminTaskController@add_file');
Route::delete('/adm/task_files/{task_file}/delete', 'AdminTaskController@delete_file');
Route::delete('/adm/tasks/{task}', 'AdminTaskController@delete');

Route::get('/adm/learning_modules', 'AdminLearningModuleController@index');
Route::post('/adm/learning_modules', 'AdminLearningModuleController@store');
Route::get('/adm/learning_modules/{lm}', 'AdminLearningModuleController@show');
Route::get('/adm/learning_modules/{lm}/edit', 'AdminLearningModuleController@edit');
Route::post('/adm/learning_modules/{lm}', 'AdminLearningModuleController@update');
Route::delete('/adm/learning_modules/{lm}', 'AdminLearningModuleController@delete');

Route::get('/adm/webinars', 'AdminWebinarController@index');
Route::post('/adm/webinars', 'AdminWebinarController@store');
Route::get('/adm/webinars/{webinar}', 'AdminWebinarController@show');
Route::get('/adm/webinars/{webinar}/edit', 'AdminWebinarController@edit');
Route::post('/adm/webinars/{webinar}', 'AdminWebinarController@update');
Route::delete('/adm/webinars/{webinar}', 'AdminWebinarController@delete');

Route::get('/adm/docx/projects/{project}/users','WordExportController@users_in_project');
Route::get('/adm/docx/assessment_template/{project}/{event}','WordExportController@assessment_template');
Route::get('/adm/docx/survey_template/{survey}','WordExportController@survey_template');
Route::get('/adm/docx/events/{event}','WordExportController@event');
Route::get('/adm/docx/stages/{stage}','WordExportController@stage');
Route::get('/adm/docx/survey/{attempt}','WordExportController@survey');
Route::get('/adm/docx/user_test/{event}/{user}','WordExportController@test');
Route::get('/adm/docx/user_case/{event}/{user}','WordExportController@case');

Route::get('/adm/docx/project_stage/{stage}/live_event_schedule/{day}','WordExportController@live_event_schedule');

Route::get('/adm/tickets','TicketController@index');
Route::get('/adm/tickets/{ticket}','TicketController@show');
Route::post('/adm/tickets','TicketController@store');
Route::post('/adm/tickets/{ticket}/add_files','TicketController@add_files');

Route::get('/adm/users','AdminUserController@index');
Route::get('/adm/users/{user}','AdminUserController@show');
Route::post('/adm/users','AdminUserController@store');
Route::delete('/adm/users/{user}','AdminUserController@delete');
Route::get('/adm/users/{user}/edit','AdminUserController@edit');
Route::post('/adm/users/{user}/update','AdminUserController@update');
Route::post('/adm/users/{user}/update_role','AdminUserController@update_role');
Route::post('/adm/users/{user}/reset_password','UserController@reset_password');

Route::get('/adm/reports','AdminReportController@index');
Route::get('/adm/reports/events/{event}','AdminReportController@show_event');
Route::get('/adm/reports/projects/{project}','AdminReportController@show_project');
Route::get('/adm/reports/users/{user}','AdminReportController@show_user');

Route::get('/adm/filials','FilialController@index');
Route::post('/adm/filials','FilialController@store');
Route::get('/adm/filials/{filial}','FilialController@show');
Route::get('/adm/filials/{filial}/edit','FilialController@edit');
Route::post('/adm/filials/{filial}/edit','FilialController@update');
Route::delete('/adm/filials/{filial}','FilialController@delete');
});