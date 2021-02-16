@extends('layouts.layout-1')


@section('header')
	Оценочные сессии
@endsection


@section('content')

<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
<div class="card">
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
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Действия
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="/adm/projects/{{$project->id}}" class="dropdown-item"><i class="fa fa-edit"></i> Управление</a> 
                        <form method="POST" id="dp_{{$project->id}}" action="/adm/projects/{{$project->id}}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="button" onclick="delete_project('{{$project->id}}','{{$project->name}}')" class="dropdown-item"><i class="fa fa-times"></i> Удалить</button>
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
          <h4 class="modal-title">Создать новую оценочную сессию</h4>
        </div>
      	<form method="POST" action="/adm/projects">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-label form-label-lg">Название:</label>
							<input type="text" class="form-control" name="name" placeholder="" required />
						</div>
						<div class="form-group">
							<label class="form-label form-label-lg">Описание (необязательно):</label>
							<textarea class="form-control" placeholder=""  rows="5" name="description"></textarea>
                        </div>
                        <div class="form-group">
							<label class="form-label form-label-lg">Тип:</label>
							<select name="type" required class="custom-select">
                                <option value="">Выберите тип</option>
                                <option value="Очная">Очная</option>
                                <option value="Очно-заочная">Очно-заочная</option>
                                <option value="Заочная">Заочная</option>
                            </select>
                        </div>
                        <div class="form-group">
							<label class="form-label form-label-lg">Место проведения (если планируется очная часть):</label>
							<input type="text" class="form-control" name="location" placeholder="" />
						</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label form-label-lg">Дата начала оценочной сессии:</label>
                            <input type="date" required class="form-control flatpickr" name="start_date" placeholder="Дата начала этапа">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label form-label-lg">Дата окончания оценочной сессии:</label>
                            <input type="date" required class="form-control flatpickr" name="end_date" id="enddate" placeholder="Дата окончания этапа">
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

    function delete_project(project,name)
	{
		Swal.fire({
			title: 'Удалить сессию '+name+'?',
			text: 'Все этапы и результаты мероприятий по жанной сессии будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#dp_'+project).submit();
  		}
		})
	}
</script>

@if (\Session::has('success_delete'))
    <script>
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection