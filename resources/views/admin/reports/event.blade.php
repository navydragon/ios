@extends('layouts.layout-1')

@php $e_d = $event->description(); @endphp

@section('header')
	<a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
    Просмотр мероприятия «{{$e_d->name}}»
@endsection


@section('content')
@if ($event->is_local == true)
    <h4>Локальное мероприятие ({{$e_d->type}}), дата завершения: {{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y')}}</h4>
@else
<h4>Мероприятие в этапе «({{$event->stage->name}}», дата завершения: {{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y')}}</h4>
@endif

<div class="card">
    <div class="card-body">
        <h5>Участвовавшие пользователи:</h5>
        <table class="table table-bordered datatables-demo">
            <thead>
            <tr><th>Пользователь</th><th>Результат</th>
            <th>Дата последней активности</th>
            @if ($event->event_type_id != 2)
            <th>Подробнее</th>
            @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($event->event_results as $result)
            <tr>
            <td>{{$result->user->name}}</td>
            <td>{{$result->is_passed == 1 ? "пройден": ""}}</td>
            <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($result->last_activity))->format('d.m.y H:i:s')}}</td>
            @if ($event->event_type_id != 2)
                <td><a href="#" data-toggle="modal" data-remote="/adm/events/{{$event->id}}/results/{{$result->user->id}}"  data-target="#myModal" class="btn btn-primary">Подробнее</a></td>
            @endif
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