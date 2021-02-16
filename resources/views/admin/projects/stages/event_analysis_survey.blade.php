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
			<h4><strong>Результаты ответов участников</strong></h4>
		</div>
		
		<table class="table table-bordered">
			<thead>
				<tr class="table-primary">
					<th>Ф.И.О.</th>
					<th>Дата заполнения</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach($event->survey_attempts as $attempt)
				<tr>
					<td>{{$attempt->user->name}}</td>
					<td>{{$attempt->updated_at}}</td>
					<td><a href="#" data-remote="/adm/modal/events/{{$event->id}}/survey_users/{{$attempt->user->id}}" class="btn btn-sm btn-info" data-target="#myModal" data-toggle="modal"><i class="fa fa-search"></i></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
		<!--<a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a>-->
	</div>
	</div>

	<div class="col-md-6">
	<div class="card">
		<div class="card-header text-center">
			<h4><strong>Анализ по вопросам</strong></h4>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr class="table-primary">
					<th>Текст вопроса</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($survey->questions as $question)
					<tr>
						<td>{{$question->body}}</td>
						<td><a href="#" data-remote="/adm/modal/events/{{$event->id}}/survey_questions/{{$question->id}}" class="btn btn-sm btn-info" data-target="#myModal" data-toggle="modal"><i class="fa fa-search"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
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