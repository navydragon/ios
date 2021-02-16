@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>Типы мероприятий</li>
	<li>Анкеты</li>
@endsection

@section('header')
	Задания
@endsection


@section('content')
<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
<div class="card">
    <div class="card-body">
		<table class="table table-bordered datatables-demo">
			<thead style="background-color: #333333; color: #fff;">
				<tr>
					<th>ID</td>
					<th>Название</th>
					<th>Описание</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tasks as $task)
					<tr>
					<td>{{$task->id}}</td>
					<td>{{$task->name}}</td>
					<td>{{$task->description}}</td>
					<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действия
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="/adm/tasks/{{$task->id}}"  class="dropdown-item"><span class="fas fa-eye"  ></span> Просмотреть</a> 
						<a href="/adm/tasks/{{$task->id}}/edit" class="dropdown-item"><span class="fas fa-edit"></span> Редактировать</a> 
                        <form method="POST" id="t_{{$task->id}}" action="/adm/tasks/{{$task->id}}">
                            @csrf {{ method_field('DELETE') }}
                            <a class="dropdown-item" href="#" onclick="delete_task('{{$task->id}}','{{$task->name}}')"><i class="fas fa-trash"></i> Удалить</a>
                        </form>
                    </div>


					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="modal" id="myModal">
	<div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Создать новое задание</h4>
        </div>
      	<form method="POST" action="/adm/tasks">
			@csrf
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
                        <div>
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
    function delete_task(task,name)
	{
		Swal.fire({
			title: 'Удалить задание '+name+'?',
			text: 'Все файлы данного задания, а также результаты его прохождения будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#t_'+task).submit();
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