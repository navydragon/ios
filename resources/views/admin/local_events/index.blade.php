@extends('layouts.layout-1')


@section('header')
	Локальные мероприятия
@endsection


@section('content')
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i> Создать локальное мероприятие</button>
    <div class="dropdown-menu" style="">
        <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/local_events/view_possible_tests">Тест</a>
        <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/local_events/view_possible_surveys">Анкету</a>
        <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/local_events/view_possible_materials">Учебный материал</a>
        <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/local_events/view_possible_tasks">Задание</a>
        <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/local_events/view_possible_cases">Кейс</a>
    </div>
</div>
<div class="card">
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
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действия
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/adm/local_events/{{$event->id}}"><i class="fas fa-eye"></i> Просмотреть</a>
                        <a class="dropdown-item" href="/adm/local_events/{{$event->id}}/edit"><i class="fas fa-edit"></i> Редактировать</a>
                        <form method="POST" id="e_{{$event->id}}" action="/adm/local_events/{{$event->id}}">
                            @csrf {{ method_field('DELETE') }}
                            <a class="dropdown-item" href="#" onclick="delete_local_event('{{$event->id}}','{{$ev->name}}')"><i class="fas fa-trash"></i> Удалить</a>
                        </form>
                    </div>
                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
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
    function delete_local_event(event,name)
	{
		Swal.fire({
			title: 'Удалить локальное мероприятие '+name+'?',
			text: 'Все результаты его прохождения будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#e_'+event).submit();
  		}
        })
    }
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