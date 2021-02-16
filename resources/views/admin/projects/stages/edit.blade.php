@extends('layouts.layout-1')


@section('breadcrumb')
	<li>Управление</li>
	<li>Оценочные сессии</li>
	<li>{{$project->name}}</li>
	<li>{{$project_stage->name}}</li>
@endsection

@section('header')
	Редактирование этапа <strong>"{{$project_stage->name}}"</strong>
@endsection


@section('content')
	<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

	<form action="/adm/projects/{{$project->id}}/stages/{{$project_stage->id}}" method="POST">
		@csrf
		<div class="btn-group">
		<a href="/adm/projects/{{$project->id}}" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
	    <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
    	</div>
    <hr>
    <h3>Основные параметры</h3>
	<div class="form-group">
		<label class="form-label form-label-lg">Название</label>
		<input type="text" class="form-control" value="{{$project_stage->name}}" placeholder="" name="name" required="">
    </div>
    <div class="form-group">
		<label class="form-label form-label-lg">Тип</label>
		<select name="type" required class="custom-select">
            <option {{$project_stage->type =='' ? 'selected':''}} value="">Выберите тип</option>
            <option {{$project_stage->type == 'Очный' ? 'selected':''}} value="Очный">Очный</option>
            <option {{$project_stage->type == 'Очно-заочный' ? 'selected':''}} value="Очно-заочный">Очно-заочный</option>
            <option {{$project_stage->type == 'Заочный' ? 'selected':''}} value="Заочный">Заочный</option>
        </select>
	</div>
	<div class="form-group">
		<label class="form-label form-label-lg">Описание</label>
		<textarea class="form-control" placeholder=""  rows="5" name="description">{!! $project_stage->description !!}</textarea>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label form-label-lg">Дата начала этапа:</label>
				<input type="date" class="form-control flatpickr" name="startdate" id="startdate" value="{{$project_stage->start_date}}" placeholder="Дата начала этапа">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label form-label-lg">Дата окончания этапа:</label>
				<input type="date" class="form-control flatpickr" value="{{$project_stage->end_date}}" name="enddate" id="enddate" placeholder="Дата окончания этапа">
			</div>
		</div>
	</div>
	</form>
	<hr>
    <h3>Выбранные мероприятия</h3>
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i> Добавить мероприятие</button>
        <div class="dropdown-menu" style="">
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_tests">Тест</a>
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_surveys">Анкету</a>
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_materials">Методический материал</a>
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_tasks">Задание</a>
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_cases">Кейс</a>
            <a class="dropdown-item" data-target="#myModal" data-toggle="modal" href="#" data-remote="/adm/modal/events/{{$project_stage->id}}/view_possible_webinars">Вебинар</a>
        </div>
    </div>
	
	<p></p>
	<div class="card">
		<table class="table table-bordered border-dark">
			<thead>
				<tr class="table-primary">
                    <th class="w-50">Мероприятие</th>
                    <th>Тип</th>
					<th class="w-10">Позиция</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@php $events = $project_stage->events; @endphp
				@foreach ($events->sortBy('sort') as $event)
				@php $ev = $event->description(); @endphp
					<tr>
                        <td>{{$ev->name}}</td>
                        <td>{{$event->description()->type}}</td>
						<td>{{$event->sort}}</td>
						<td>
                            <div class="btn-group btn-group-sm">
							@if ($event->sort != 1)
							<a href="/adm/events/{{$event->id}}/moveup" class=" btn btn-sm btn-info mr-1"><i class="fa fa-arrow-up"></i></a> 
							@else <span> </span>
							@endif
							@if ($event->sort != $events->count())
							<a href="/adm/events/{{$event->id}}/movedown" class=" btn btn-sm btn-info mr-1"><i class="fa fa-arrow-down"></i></a>
							@else <span> </span>
                            @endif
                            <form method="POST" id="de_{{$event->id}}" action="/adm/projects/{{$project->id}}/events/{{$event->id}}">
                                @csrf {{ method_field('DELETE') }}
                                <a href="#" onclick="delete_event('{{$event->id}}','{{$ev->name}}')" class="btn btn-sm btn-danger mr-1"><i class="fa fa-trash"></i> Удалить</a>
                            </form>
                            </div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>


	<hr>

<h3>Оценка мероприятий</h3>
<div class="card">
	<table class="table table-bordered">
		<thead>
			<tr class="table-primary">
				<th>Мероприятие</th>
				<th>Тип</th>
				<th>Оценивать</th>
				<th class="w-30">Критерии оценки</th>
				@if ($project->competence_assessment)
					<th class="w-30">Компетенции</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach ($project_stage->events as $event)
			<tr>
				<td>{{$event->description()->name}}</td>
				<td>{{$event->description()->type}}</td>
				<td><a href="#" class="event_assess" data-value="{{$event->assessment}}" data-pk="{{$event->id}}" data-url= "/adm/projects/events/{{$event->id}}/update_event_assessment"></a></td>
				<td>
					<ul class="list-group">
					@foreach( $event->criterias as $criteria)	
		                <li class="list-group-item d-flex justify-content-between align-items-center">{{$criteria->name}}
		                    <button type="button" class="btn icon-btn btn-xs btn-outline-danger"><span class="fa fa-trash"></span></button>
		                </li>
	                @endforeach

            </ul>

					<button type="button" data-target="#AddCriteriaDialog" data-toggle="modal" class="btn icon-btn btn-sm btn-success pull-right mt-1 open-AddCriteriaDialog" data-id="{{$event->id}}">
                            <span class="fa fa-plus"></span>
                        </button>
				</td>
				@if ($project->competence_assessment)
					<td><a href="#" class="event_competences" data-pk="{{$event->id}}" data-url="/adm/projects/events/{{$event->id}}/update_event_competences"  data-value="{{$event->competences->pluck('id')}}"></a></td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>




<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавление мероприятия </h4>
        </div>     
        	<div class="modal-body">
				<p></p>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>	         
	        </div>
      </div>
    </div>
</div>

<div class="modal" id="editModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Редактирование мероприятия </h4>
        </div>     
        	<div class="modal-body">
				<p></p>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>	         
	        </div>
      </div>
    </div>
</div>

<div class="modal" id="AddCriteriaDialog">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить критерий оценки мероприятию </h4>
        </div>
        <form method="POST" action="/adm/projects/events/add_criteria">
        @csrf     
    	<div class="modal-body">
			<label class="form-label form-label-lg">Название критерия</label>
		<input type="text" class="form-control" value="" placeholder="" name="name" required="">
		<input type="hidden" class="form-control" value="" placeholder="" name="event_id" id="event_id_hid">
    	</div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
          <button type="submit" class="btn btn-primary">Добавить</button>	         
        </div>
	    </form>
      </div>
    </div>
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

	
	$('.event_assess').editable({
            type: 'select',
    		title: 'Оценивать мероприятие?',
        	source: [
              {value: 0, text: 'Нет'},
              {value: 1, text: 'Да'},
           	],
        });
	
	$('.event_competences').editable ({
		emptytext: 'Компетенции не выбраны',
   
        type: 'checklist',
			pk: '{{$project->id}}',
		title: 'Выберите статус',
    	source: [
    		@foreach ($project->competences as $competence)
          		{value: '{{$competence->id}}', text: '{{$competence->name}}'},
          	@endforeach
       	]
	})

    function delete_event(event,name)
	{
		Swal.fire({
			title: 'Удалить мероприятие '+name+' из данной оценочной сессии?',
			text: '',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#de_'+event).submit();
  		}
		})
	}

</script>



<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    }); 

$(document).on("click", ".open-AddCriteriaDialog", function () {
     var eventid = $(this).data('id');
     $("#event_id_hid").val( eventid );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>


<script>
    @if (\Session::has('success_delete'))
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    @endif
</script>
@endsection