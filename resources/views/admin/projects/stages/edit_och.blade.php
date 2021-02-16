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
	<h3>Расписание</h3>
	@foreach ($days as $day)
	<h4>День {{$day}} </h4>
	<a data-target="#myModal" data-toggle="modal" href="#" class="btn btn-primary btn-sm" name="" data-date="{{$day}}"><i class="fa fa-plus"></i> Добавить мероприятие</a> 
	<a href="/adm/docx/project_stage/{{$project_stage->id}}/live_event_schedule/{{$day}}" class="btn btn-info btn-sm" ><i class="fa fa-plus"></i> Экспорт</a>
	<p></p>
	<div class="card">
		<table class="table table-bordered border-dark">
			<thead>
				<tr class="table-primary">
					<th class="w-50">Время</th>
					<th class="w-10">Мероприятие</th>
					<th>Ответственный</th>
					<th>Примечание</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($project_stage->live_events($project_stage->id,$day) as $event)
				<tr>
					<td>{{$event->start_time}}-{{$event->end_time}}</td>
					<td>{{$event->name}}</td>
					<td>{{$event->responsible}}</td>
					<td>{{$event->note}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<hr>
	@endforeach
	
	
	


	<hr>


<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавление мероприятия </h4>
        </div>   
        	<form action="/adm/projects/stages/{{$project_stage->id}}/add_och_event" method="POST">
        	@csrf  
        	<div class="modal-body">
				<div class="form-group">
					<label class="form-label form-label-lg">День</label>
					<input type="text" class="form-control" placeholder="" name="date"  id="date">
				</div>
				<div class="form-group">
					<label class="form-label form-label-lg">Название мероприятия</label>
					<input type="text" class="form-control" placeholder="" name="name" required="">
				</div>
				<div class="form-group">
					<label class="form-label form-label-lg">Время начала</label>
					<input type="text" class="form-control" name="start_time" placeholder="__:__" required="">
				</div>
				<div class="form-group">
					<label class="form-label form-label-lg">Время завершения</label>
					<input type="text" class="form-control" name="end_time" placeholder="__:__" required="">
				</div>
				<div class="form-group">
					<label class="form-label form-label-lg">Ответственный</label>
					<input type="text" class="form-control" placeholder="" name="responsible">
				</div>
				<div class="form-group">
					<label class="form-label form-label-lg">Примечание</label>
					<input type="text" class="form-control" placeholder="" name="note" >
				</div>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
	          <button type="submit"  class="btn btn-primary">Добавить</a>     
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
<script src="{{ mix('/vendor/libs/vanilla-text-mask/vanilla-text-mask.js') }}"></script>
<script src="{{ mix('/vendor/libs/vanilla-text-mask/text-mask-addons.js') }}"></script>
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

</script>



<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    }); 

$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var date = button.data('date') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  $('#date').attr('value', date);
})
</script>

@endsection