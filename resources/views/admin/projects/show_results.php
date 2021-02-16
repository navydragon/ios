@extends('layouts.layout-1')


@section('header')
	{{$project->name}}
@endsection


@section('content')
<input type="hidden" name="_token" id="_token" value="{{ Session::token() }}" />
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/projects" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#stages">Этапы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#users">Участники</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#competence">Компетенции</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <form action="/adm/projects/{{$project->id}}" method="POST">
                    @csrf
                    <h5>Основные параметры</h5>
                    <div class="form-group ">
                        <label class="form-label form-label-lg">Статус оценочной сессии</label>
                        <select class="custom-select col-md-4" name="status">
                            <option {{$project->status == 1 ? "selected" : ""}} value="1">Подготовка</option>
                            <option {{$project->status == 2 ? "selected" : ""}} value="2">Активна</option>
                            <option {{$project->status == 3 ? "selected" : ""}} value="3">Отменена</option>
                            <option {{$project->status == 4 ? "selected" : ""}} value="4">Завершена</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label form-label-lg">Название</label>
                        <input type="text" class="form-control" value="{{$project->name}}" placeholder="" name="name" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-label form-label-lg">Описание</label>
                        <textarea class="form-control" placeholder=""  rows="5" name="description">{!! $project->description !!}</textarea>
                    </div>
                   
                    <div class="form-group">
                        <label class="form-label form-label-lg">Тип:</label>
                        <select name="type" required class="custom-select">
                            <option {{$project->type =='' ? 'selected':''}} value="">Выберите тип</option>
                            <option {{$project->type == 'Очная' ? 'selected':''}} value="Очная">Очная</option>
                            <option {{$project->type == 'Очно-заочная' ? 'selected':''}} value="Очно-заочная">Очно-заочная</option>
                            <option {{$project->type == 'Заочная' ? 'selected':''}} value="Заочная">Заочная</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label form-label-lg">Место проведения (если планируется очная часть):</label>
                        <input type="text" value="{{$project->location}}" class="form-control" name="location" placeholder="" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label form-label-lg">Дата начала оценочной сессии:</label>
                                <input type="date" class="form-control flatpickr" name="start_date" id="pr_startdate" value="{{$project->start_date}}" placeholder="Дата начала этапа">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label form-label-lg">Дата окончания оценочной сессии:</label>
                                <input type="date" class="form-control flatpickr" value="{{$project->end_date}}" name="end_date" id="pr_enddate" placeholder="Дата окончания этапа">
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="stages">
            <div class="card-body">
                <h5>Управление этапами</h5>
                <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить этап</a>
                <p></p>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Название этапа</th>
                                <th>Тип</th>
                                <th>Даты проведения</th>
                                <th>Мероприятий</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($project->stages->count() == 0)
                                <tr>
                                    <td colspan="5"><em>Нет этапов</em></td>
                                </tr>
                            @else
                                @foreach($project->stages as $stage)
                                <tr>
                                    <td>{{$stage->name}}</td>
                                    <td>{{$stage->type}}</td>
                                    <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->start_date))->format('d.m.y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->end_date))->format('d.m.y')}}</td>
                                    <td>{{$stage->events->count()}}</td>
                                    <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Действия
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/adm/projects/{{$project->id}}/stages/{{$stage->id}}/edit"><i class="fa fa-edit"></i> Редактировать</a>
                                        <a class="dropdown-item" href="/adm/projects/{{$project->id}}/stages/{{$stage->id}}/analysis"><i class="fa fa-eye"></i> Анализ</a> 
                                        <form method="POST" id="s_{{$stage->id}}" action="/adm/projects/{{$project->id}}/stages/{{$stage->id}}">
                                            @csrf {{ method_field('DELETE') }}
                                            <a class="dropdown-item" href="#" onclick="delete_stage('{{$stage->id}}','{{$stage->name}}')"><i class="fas fa-trash"></i> Удалить</a>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="users">
            <div class="card-body">
                <h4 class="margin-bottom-10"><strong>Участники сессии</strong></h4>
                <table class="table table-bordered datatables-demo">
                    <thead>
                        <tr>
                            <th>Ф.И.О.</th>
                            <th>Филиал, подразделение</th>
                            <th>Должность</th>
                            <th>Контакты</th>
                            <th>Роль</th>
                            <th>Дата присоединения</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($project->users as $user )
                            @php
                                $role = DB::table('project_roles')->where('id', $user->pivot->role_id)->first();
                            @endphp
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->filial->name}}<br>{{$user->division}}</td>
                                    <td>{{$user->job}}</td>
                                    <td>{{$user->email}}<br>{{$user->phone}}</td>
                                    <td><a href="#" data-pk="{{$user->id}}" data-value="{{$role->id}}" class="roles"></a></td>
                                    <td>{{$user->get_join_date()}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="/adm/projects/{{$project->id}}/users/{{$user->id}}/analysis" class="btn btn-sm btn-info"><span class="fas fa-eye"> Просмотр</span></a>
                                            <form method="POST" id="du_{{$user->id}}" action="/adm/projects/{{$project->id}}/users/{{$user->id}}">
                                                @csrf {{ method_field('DELETE') }}
                                                <a href="#" class="btn btn-sm btn-danger ml-2" onclick="decline_user('{{$user->id}}','{{$user->name}}')" class="dropdown-item"><i class="fa fa-times"></i> Отклонить</a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="competence">
            <div class="card-body">
                <h5 class="margin-bottom-10">Компетенции</h5>
                    <label>Оценивать компетенции </label>
                    <table class="table">      
                        <tbody>
                            <tr><td><a href="#" id="status"></a></td></tr>
                            <tr><td>
                                <div id="competences_container" class="col-md-12" style="display:{{$project->competence_assessment == 0 ? 'none' : 'block'}};">
                                    <a href="#" id="competences"></a>
                                </div>
                            </td></tr>
                        </tbody>              
                    </table>
            </div>
        </div>
    </div>
</div>



		

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Создать новый этап оценочной сессии</h4>


        </div>
      	<form method="POST" action="/adm/projects/{{$project->id}}/stages">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-label form-label-lg">Название:</label>
							<input type="text" class="form-control" name="name" placeholder="" required />
						</div>
					</div>
                </div>
                <div class="form-group">
                    <label class="form-label form-label-lg">Тип:</label>
                    <select name="type" required class="custom-select">
                        <option  value="">Выберите тип</option>
                        <option  value="Очный">Очный</option>
                        <option  value="Очно-заочный">Очно-заочный</option>
                        <option  value="Заочный">Заочный</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label form-label-lg">Описание (необязательно):</label>
                        <textarea class="form-control" placeholder=""  rows="5" name="description"></textarea>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label form-label-lg">Дата начала этапа:</label>
							<input type="date" required class="form-control flatpickr" name="startdate" id="startdate" placeholder="Дата начала этапа">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label form-label-lg">Дата окончания этапа:</label>
							<input type="date" required class="form-control flatpickr" name="enddate" id="enddate" placeholder="Дата окончания этапа">
						</div>
					</div>
				</div>
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
    $('.datatables-demo').dataTable();
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.params = function (params) {
    params._token = $("#_token").val();
    return params;
	};

	$('#status').editable({
        	value: '{{$project->competence_assessment}}',    
            type: 'select',
   			pk: '{{$project->id}}',
    		url: '/adm/projects/{{$project->id}}/change_competence_assess',
    		title: 'Выберите статус',
        	source: [
              {value: 0, text: 'Нет'},
              {value: 1, text: 'Да'},
           	],
           	success: function(response, newValue) {
           		 $( "#competences_container" ).slideToggle( "slow" );
        	}
        });

	$('#competences').editable ({
		emptytext: 'Компетенции не выбраны',
		url: '/adm/projects/{{$project->id}}/change_competences',
		pk: '{{$project->id}}',
		value: [
			    @foreach ($project->competences as $pc)
              		'{{$pc->id}}',
              	@endforeach
		],    
        type: 'checklist',
		pk: '{{$project->id}}',
		title: 'Выберите компетенции',
    	source: [
    		@foreach ($competences as $competence)
          		{value: '{{$competence->id}}', text: '{{$competence->name}}'},
          	@endforeach
       	]
	})

	$('.roles').editable ({
		emptytext: 'Роль не выбрана',
		type: 'select',
		title: 'Выберите роль',
		source: [
    		@foreach ($roles as $role)
          		{value: '{{$role->id}}', text: '{{$role->name}}'},
          	@endforeach
       	],
       	url: '/adm/projects/{{$project->id}}/update_user_role',
	})


  function decline_user(user,name)
	{
		Swal.fire({
			title: 'Отклонить участие пользователя '+name+' в оценочной сесии?',
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
			$('#du_'+user).submit();
  		}
		})
    }
    
    function delete_stage(stage,name)
	{
		Swal.fire({
			title: 'Удалить этап '+name+'?',
			text: 'Все мероприятия данного этапа, а также результаты их прохождения будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#s_'+stage).submit();
  		}
		})
	}
	
</script>

@if (\Session::has('success_project'))
    <script>
        toastr.success('{!! \Session::get('success_project') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@if (\Session::has('success_stage'))
    <script>
        $('a[href="#stages"]').tab('show')
        toastr.success('{!! \Session::get('success_stege_store') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@if (\Session::has('success_user'))
    <script>
        $('a[href="#users"]').tab('show')
        toastr.success('{!! \Session::get('success_user') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

<script>
    @if (\Session::has('stage_success'))
        $('a[href="#stages"]').tab('show')
        toastr.success('{!! \Session::get('stage_success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    @endif
</script>

@endsection