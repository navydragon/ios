@extends('layouts.layout-1')


@section('header')
	<a href="/adm/reports" class="btn btn-primary">Назад</a>
    Просмотр результатов пользователя «{{$user->name}}»
@endsection


@section('content')

<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#projects">Оценочные сессии</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#events">Локальные мероприятия</a>
        </li>
    </ul>
</div>


<div class="tab-content">
    <div class="tab-pane fade card active show" id="projects">
        <div class="card-body">
            <div class="cui-example">
                <div id="accordion2">
                    @foreach($user->projects as $project)
                    <div class="card mb-2">
                        <div class="card-header">
                            <a class="d-flex justify-content-between text-body collapsed" data-toggle="collapse" aria-expanded="false" href="#accordion2-{{$project->id}}">
                            {{$project->name}} ({{\Carbon\Carbon::createFromTimeStamp(strtotime($project->start_date))->format('d.m.Y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->end_date))->format('d.m.Y')}})
                            <div class="collapse-icon"></div>
                            </a>
                        </div>

                        <div id="accordion2-{{$project->id}}" class="collapse" data-parent="#accordion2" style="">
                            <div class="card-body">
                            <a href="#" class="btn btn primary">Экспорт результатов</a>
                            @foreach ($project->stages as $stage)
                                <h5>Этап: {{$stage->name}} ({{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->start_date))->format('d.m.Y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->end_date))->format('d.m.Y')}})</h5>
                                <table class="table table-bordered">
                                <thead><tr><th>Мероприятие</th><th>Тип</th><th>Участвовало пользователей</th><th>Действия</th></tr></thead>
                                <tbody>
                                @foreach ($stage->events as $event)
                                    @php $e_d = $event->description(); @endphp
                                    <tr>
                                        <td>{{$e_d->name}}</td>
                                        <td>{{$e_d->type}}</td>
                                        <td>{{$event->event_results()->count()}}</td>
                                        <td><a href="/adm/reports/events/{{$event->id}}" class="btn btn-primary"> Результаты мероприятия </a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade card" id="events">
    <div class="card-body">
        <table class="table table-bordered datatables-demo">
			<thead style="background-color: #333333; color: #fff;">
				<tr>
					<th>ID</th>
					<th>Название</th>
					<th>Тип</th>
					<th>Дата последнего обращения</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($user->local_events() as $event_result)
                    @if ($event_result->event->is_local == true)
                    @php $e_d = $event_result->event->description(); @endphp
					<tr>
					<td>{{$event_result->id}}</td>
                    <td>{{$e_d->name}}</td>
                    <td>{{$e_d->type}}</td>
                    <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($event_result->last_activity))->format('d.m.Y H:i:s')}}</td>
                    <td><a href="#" data-toggle="modal" data-remote="/adm/events/{{$event_result->event->id}}/results/{{$user->id}}"  data-target="#myModal" class="btn btn-primary">Подробнее</a></td>
					</tr>
                    @endif
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
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
          <h4 class="modal-title"></h4>
        </div>

        	<div class="modal-body">
				
        	</div>
	       
    </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">
	$('.datatables-demo').dataTable();
    
</script>
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    }); 
</script>


@if (\Session::has('success_delete'))
    <script>
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection