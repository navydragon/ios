@extends('layouts.layout-1')


@section('header')
	<a href="/adm/reports" class="btn btn-primary">Назад</a>
    Просмотр оценочной сессии «{{$project->name}}»
@endsection


@section('content')
    <h4>Даты проведения: {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->start_date))->format('d.m.Y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->end_date))->format('d.m.Y')}}</h4>


<div class="card">
    <div class="card-body">
        @foreach ($project->stages as $stage)
        <h5>Этап: {{$stage->name}} ({{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->start_date))->format('d.m.Y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->end_date))->format('d.m.Y')}})</h5>
        <a href="/adm/docx/stages/{{$stage->id}}" class="btn btn-primary">Экспорт результатов</a>
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

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
          <h4 class="modal-title"></h4>
        </div>

        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
						<div class="form-group">
							<label class="form-label form-label-lg">Описание (необязательно):</label>
							<textarea class="form-control" placeholder="" rows="5" name="description"></textarea>
						</div>
					</div>
				</div>
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