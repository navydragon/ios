@extends('layouts.layout-1')
@php $e_d = $event->description(); @endphp
@section('breadcrumb')
	<li>Управление</li>
	<li>Оценочные сессии</li>
	<li>{{$project_stage->project->name}}</li>
	<li>{{$project_stage->name}}</li>
	<li>{{$e_d->name}}</li>
@endsection

@section('header')
	{{$e_d->name}}: анализ
@endsection


@section('content')
<div class="btn-group">
		<a href="/adm/projects/{{$project_stage->project->id}}/stages/{{$project_stage->id}}/analysis" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
		<a href="#" class="btn btn-info"><span class="fas fa-file-download"></span> Скачать результаты</a>
</div>
<p></p>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header text-center">
				<h4><strong>Анализ по участникам</strong></h4>
			</div>
			<div class="card-datatable table-responsive">
				<table id="dt_basic" class="table table-striped table-bordered table-hover datatables-demo" width="100%">
					<thead>			                
						<tr>
							<th data-hide="phone">ID попытки</th>
							<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Ф.И.О.</th>
								<th>Результат</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						@foreach($event->test_attempts as $attempt)
						<tr>
							<td>{{$attempt->id}}</td>
							<td>{{$attempt->user->name}}</td>
							<td>{{$attempt->score}} / {{$test->questions->count()}}</td>
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
			</div>
		</div>
	</div>

	<div class="col-md-6">
	<div class="card">
		<div class="card-header text-center">
			<h4><strong>Анализ по вопросам</strong></h4>
		</div>
		<div class="card-datatable table-responsive">
			<table id="dt_questions" class="table table-striped table-bordered table-hover datatables-demo" width="100%">
				<thead>			                
					<tr>
						<td>ID</td>
						<td>Текст вопроса</td>
						<td>Правильных ответов</td>
						<td>Неправильных ответов</td>
						<td>Подробнее</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($test->questions as $question)
					<tr>
						<td>{{$question->id}}</td>
						<td>{{$question->name}}</td>
						<td>{{$question->right_answers_in_event($event->id)}}</td>
						<td>{{$question->bad_answers_in_event($event->id)}}</td>
						<td><div class="btn-group">
								<a href="#" data-remote="/adm/modal/events/{{$event->id}}/tests/questions/{{$question->id}}/review" class="btn btn-info" data-target="#myModal" data-toggle="modal"><i class="fa fa-search"></i></a>
							</div></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>


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
	        </div>
      </div>
    </div>
</div>


@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection

@section('scripts')

<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
</script>

<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();

</script>

@endsection