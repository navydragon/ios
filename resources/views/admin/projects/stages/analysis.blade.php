@extends('layouts.layout-1')


@section('header')
	{{$project_stage->name}}: анализ
@endsection


@section('content')
<div class="btn-group">
		<a href="/adm/projects/{{$project->id}}" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
</div>
<p></p>
	<h4>Мероприятия этапа</h4>
	<div class="card">
		<table class="table table-bordered">
			<thead>
				<tr class="table-primary">
					<th>ID</th>
					<th>Название</th>
					<th>Участвовало</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($project_stage->events as $event)
				@php $e_d = $event->description(); @endphp
					<tr>
						<td>{{$event->id}}</td>
						<td>{{$e_d->name}}</td>
						<td>{{$event->user_count()}}</td>
						<td>
							<a href="/adm/projects/{{$project_stage->project->id}}/stages/{{$project_stage->id}}/events/{{$event->id}}/assess" class="btn btn-sm btn-primary"><i class="fa fa-star"></i> Оценить</a>
							<a href="/adm/projects/{{$project_stage->project->id}}/stages/{{$project_stage->id}}/analysis/events/{{$event->id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Результаты</a>

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<!--<a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a>-->

	</div>

<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Создать новую оценочную сесси.</h4>
        </div>
        	<div class="modal-body">
				
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Создать</button>
	        </div>
      </div>
    </div>
</div>


@endsection

