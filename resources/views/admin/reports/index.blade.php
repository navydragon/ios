@extends('layouts.layout-1')


@section('header')
	Отчетность и аналитика
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
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#users">Пользователи</a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane fade card active show" id="projects">
    <div class="card-body">
        <table id="dt_basic" class="table datatables-demo table-striped table-bordered table-primary" width="100%">
            <thead style="background-color: #333333; color: #fff;">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Описание</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>
                        <td>{{$project->p_status->name}}</td>
                        <td>{{$project->description}}</td>
                        <td>
                            <a href="/adm/reports/projects/{{$project->id}}" class="btn btn-primary"> Результаты </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                        <th>Дата завершения</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    @php $ev = $event->description(); @endphp
                        <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$ev->name}}</td>
                        <td>{{$ev->type}}</td>
                        <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y')}} </td>
                        <td>
                            <a href="/adm/reports/events/{{$event->id}}" class="btn btn-primary"> Результаты </a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade card" id="users">
        <div class="card-body">
        <table class="table table-bordered datatables-demo">
			<thead style="background-color: #333333; color: #fff;">
				<tr>
					<th>ID</th>
					<th>Ф.И.О.</th>
					<th>Филиал</th>
					<th>Должность</th>
					<th>Контакты</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->filial ? $user->filial->name : ""}}</td>
					<td>{{$user->job}}</td>
					<td>{{$user->email}}<br>{{$user->phone}}</td>
					<td>
                        <a href="/adm/reports/users/{{$user->id}}" class="btn btn-primary"> Результаты </a>
                    </td>
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
          <h4 class="modal-title">Создать новый тест</h4>
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


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection