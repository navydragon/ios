@extends('layouts.layout-1')


@section('header')
	Оценка мероприятия "{{$event->description()->name}}" экспертом {{Auth::user()->name}}
@endsection


@section('content')
<div class="btn-group">
		<a href="/adm/projects/{{$project->id}}/stages/{{$project_stage->id}}/analysis" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
		<a href="/adm/docx/assessment_template/{{$project->id}}/{{$event->id}}" class="btn btn-info"><span class="fas fa-file-download"></span> Скачать шаблон оценки</a>
</div>
<p></p>
<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
<div class="card">
<table class="table table-bordered">
	<thead>
		<tr class="table-primary">
			<th>Участник</th>
			@foreach ($event->criterias as $criteria)
			<th>{{$criteria->name}}</th>
			@endforeach
			<th>Общая оценка</th>
			@if($project->competence_assessment)
				@foreach ($event->competences as $competence)
				<th>{{$competence->name}}</th>
				@endforeach
			@endif
		</tr>
	</thead>
	<tbody>
	@foreach ($project->members as $member)
		<tr>
			<td>{{$member->name}}</td>
			@foreach ($event->criterias as $criteria)
				<td><a href="#" data-pk="{{$member->id}}" data-name="{{$criteria->id}}" data-value="{{$member->get_event_criteria_by_expert($event->id,Auth::user()->id,$criteria->id)}}" class="event_criteria_mark"></a></td>
			@endforeach
			<td><a href="#" data-pk="{{$member->id}}" data-value="{{$member->get_event_mark_by_expert($event->id,Auth::user()->id)}}" class="event_mark"></a></td>
			@if($project->competence_assessment)
				@foreach ($event->competences as $competence)
				<td><a href="#" data-pk="{{$member->id}}" data-name="{{$competence->id}}" data-value="{{$member->get_event_competence_mark_by_expert($event->id,Auth::user()->id,$competence->id)}}" class="event_competence_mark"></a></td>
				@endforeach
			@endif
		</tr>
	@endforeach
	</tbody>
</table>
</div>
@endsection

@section('styles')
	<link rel="stylesheet" href="/vendor/libs/bootstrap-editable/bootstrap-editable.css">
@endsection

@section('scripts')
<script src="/vendor/libs/bootstrap-editable/bootstrap-editable.min.js"></script>
	<script type="text/javascript">
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.params = function (params) {
    params._token = $("#_token").data("token");
    return params;
	};
	</script>

	<script type="text/javascript">
	$('.event_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/assess',
	})
	$('.event_competence_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/competence_assess',
	})
	$('.event_criteria_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/criteria_assess',
	})
	</script>
@endsection