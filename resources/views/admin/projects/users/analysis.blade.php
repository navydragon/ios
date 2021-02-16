@extends('layouts.layout-1')



@section('header')
	{{$user->name}}: анализ
@endsection


@section('content')
<div class="btn-group">
		<a href="/adm/projects/{{$project->id}}" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
</div>
<p></p>

@foreach ($project->stages as $stage)
<div class="card">
	<h4 class="card-header">
		{{$stage->name}}
	</h4>
	<div class="nav-tabs-left mb-4">
                <ul class="nav nav-tabs nav-pills">
                	@foreach ($stage->events as $event)
                	@php $success = $event->user_success($user->id); @endphp
                    <li class="nav-item">

                        <a class="nav-link" data-toggle="tab" href="#e{{$event->id}}">
                        	@if ($success)
                        		<span class="badge badge-outline-success"><i class="fas fa-check"></i></span>
                        	@endif
                        	{{$event->description()->name}} 
                        </a>
                        
                    </li>
                    @endforeach
                   
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-left-home">
                        <div class="card-body">
                            <p>Выберите мероприятие</p>
                        </div>
                    </div>
                    @foreach ($stage->events as $event)
                    	@php 
                    		$e_d = $event->description();
                    		$success = $event->user_success($user->id); 
                    	@endphp
	                    <div class="tab-pane fade" id="e{{$event->id}}">
	                        <div class="card-body">
	                            <h4>
	                            	{{$e_d->name}}
	                            	@if ($success)
	                            	<span class="badge badge-outline-success">Выполнено</span>
	                            	@endif 
	                            </h4> 
	                            @switch($e_d->type_link)
							    @case("survey")
							        <table class="table table-bordered">
									    <thead>
									      <tr class="table-primary">
									        <th>Вопрос</th>
									        <th>Текст ответа</th>
									      </tr>
									    </thead>
									    <tbody>
									    @foreach ($user->survey_attempts_in_event($event->id) as $attempt)
								        	@foreach ($attempt->answers as $answer)
									          <tr>
									            <td>{{$answer->question->body}}</td>
									            <td>{{$answer->answer_text}}</td>
									          </tr>
								        	@endforeach
								       	@endforeach
									    </tbody>
									  </table>
									  <a href="/adm/docx/survey/{{$attempt->id}}" class="btn btn-info">Экспорт</a>
							    @break

							    @case("test")
							        <table class="table table-striped table-bordered table-hover datatables-demo">
										<thead>			                
											<tr class="table-primary">
												<th data-hide="phone">ID попытки</th>
												<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Ф.И.О.</th>
													<th>Результат</th>
												<th>Дата</th>
												<th>Действия</th>
											</tr>
										</thead>
										<tbody>
											@foreach($user->test_attempts_in_event($event->id) as $attempt)
											<tr>
												<td>{{$attempt->id}}</td>
												<td>{{$attempt->user->name}}</td>
												<td>{{$attempt->score}} / {{$attempt->test->questions()->count()}}</td>
												<td>{{$attempt->updated_at}}</td>
												<td>
													<div class="btn-group">
														<a href="#" data-remote="/adm/modal/events/tests/attempts/{{$attempt->id}}/review" class="btn btn-info" data-target="#myModal" data-toggle="modal"><i class="fa fa-search"></i></a>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
							    @break

							    @case("task")
							        <table class="table table-bordered">
							        	<thead>
							        		<tr class="table-primary">
							        			<th>Файл</th>
							        			<th>Тип</th>
							        			<th>Дата загрузки</th>
							        		</tr>
							        	</thead>
										<tbody>
											@foreach ($user->event_files($event->id)->get() as $event_file)
												<tr>
													<td><a href="/{{$event_file->file->path}}">{{$event_file->file->title}}</a></td>
													<td>{{$event_file->file->type}}</td>
													<td>{{$event_file->created_at}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
							    @break

							    @default
							        <span>Что-то пошло не так, попробуйте еще раз</span>
								@endswitch
	                        </div>
	                    </div>
	                @endforeach
                </div>
            </div>
</div>
@endforeach

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"> </h4>
        </div>
        	<div class="modal-body">
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Создать</button>
	        </div>
	    </form>
      </div>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
</script>
@endsection