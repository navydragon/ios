@extends('layouts.layout-1')



@section('header')
	{{$case->name}} 
@endsection


@section('content')
    <div class="nav-tabs-top">
        <ul class="nav nav-tabs">
            <li>
                <a href="/adm/cases" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tasks">Задания к кейсу</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#files">Дополнительные файлы</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="data">
                <div class="card-body">
                    <form action="/adm/cases/{{$case->id}}" method="POST">
                        @csrf
                        <hr>
                        <h3>Основные параметры</h3>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Название кейса</label>
                            <input type="text" class="form-control" value="{{$case->name}}" placeholder="" name="name" required="">
                        </div>

                        <div class="form-group">
                            <label class="form-label form-label-lg">Для каких категорий работников</label>
                            <input type="text" class="form-control" value="{{$case->categories}}" placeholder="" name="categories">
                        </div>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Краткое описание</label>
                            <textarea  class="form-control" name="short_description">{{$case->short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Степень тяжести несчастного случая</label>
                            <select name="weight" class="custom-select">
                                <option value="С летальным исходом" {{$case->weight == "С летальным исходом"?"selected":""}}>С летальным исходом</option>
                                <option value="Тяжелый" {{$case->weight == "Тяжелый"?"selected":""}}>Тяжелый</option>
                                <option value="Легкий" {{$case->weight == "Легкий"?"selected":""}} >Легкий</option>
                                <option value="" {{$case->weight == ""?"selected":""}}>Другое</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label form-label-lg">Описание ситуации/Условие</label>
                            <textarea  name="conditions" class="form-control summernote" rows="10">{!! $case->conditions !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Детальное описание</label>
                            <textarea  name="description" class="form-control summernote" rows="10">{!! $case->description !!}</textarea>
                        </div>                
                        @if (Auth::user()->role_id == 1)
                        <div class="form-group">
                            <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_recommend" {{$case->is_recommend ? "checked": ""}}>
                            <div class="form-check-label">
                                Является рекомендованным для изучения
                            </div>
                            </label>
                        </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="tasks">
                <div class="card-body">
                    <h3>Задания</h3>
                    <p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#addTask"><i class="fa fa-plus"></i> Добавить задание</a></p>
                    <div class="list-group">
                        @if ($case->tasks->count() == 0)
                            <li class="list-group-item d-flex justify-content-between align-items-center"><em>Пока не добавлено ни одного задания</em> </li>
                        @else
                            @php $n=1; @endphp
                            @foreach ($tasks as $task)
                            <li class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between w-100">
                            <h5 class="mb-1">Задание №{{$n}}</h5>
                            <small><button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Действия
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if ($task->sort != 1)
                                <a href="/adm/cases/{{$case->id}}/tasks/{{$task->id}}/move_up" class="dropdown-item"><i class="fa fa-arrow-up"></i> Поднять выше</a>
                                @endif
                                @if ($task->sort != $tasks->count())
                                <a href="/adm/cases/{{$case->id}}/tasks/{{$task->id}}/move_down" class="dropdown-item"><i class="fa fa-arrow-down"></i> Опустить ниже</a>
                                @else
                                <span></span>
                                @endif
                                <a href="#" data-remote="/adm/cases/{{$case->id}}/edit_task/{{$task->id}}"  data-toggle="modal"  data-target="#edit_task_modal" class="dropdown-item"><i class="fa fa-edit"></i> Редактировать</a> 
                                
                                <form method="POST" id="t_{{$task->id}}" action="/adm/cases/{{$case->id}}/tasks/{{$task->id}}">
                                    @csrf {{ method_field('DELETE') }}
                                    <a  class="dropdown-item" href="#" onclick="delete_task('{{$task->id}}','{{$n}}')"><i class="fas fa-trash"></i> Удалить</a>
                                </form>
                            </div></small>
                            </div>
                            {!! $task->task !!}
                            </li>
                                @php $n++; @endphp
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="files">
                <div class="card-body">
                    <h3>Дополнительные файлы:</h3>
                    <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить файл</a>
                    <p></p>
                    @if ($case->files->count() == 0)
                            <li class="list-group-item d-flex justify-content-between align-items-center"><em>Пока не добавлено ни одного файла</em> </li>
                    @else
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($case->files as $file)
                            @php $source = $file->source; @endphp
                            <tr>
                                <td><a href="/{{$source->path}}" target="_blank">{{$source->title}}</a></td>
                                <td>
                                    <form action="/adm/case_files/{{$file->id}}/delete" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!-- <a href="#" class="btn btn-sm btn-default"><i class="fa fa-arrow-up"></i></a> 
                                        <a href="#" class="btn btn-sm btn-default"><i class="fa fa-arrow-down"></i></a> -->
                                        <button type="submit" class="btn btn-sm btn-danger"/><i class="fa fa-trash"></i> Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
			
<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить новый файл</h4>
        </div>
      	<form method="POST" enctype="multipart/form-data" action="/adm/cases/{{$case->id}}/add_file">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Название файла</label>
	                   		<input name="name" class="form-control"  required="">
	                    	<small class="form-text text-muted">Название файла, как его увидит участник</small>
                		</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Добавление нового файла</label>
	                   		<input name="file" type="file" required="">
	                    	<small class="form-text text-muted">Выберите файл на ПК и нажмите кнопку "Добавить".</small>
                		</div>
					</div>
				</div>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Добавить</button>
	        </div>
	    </form>
      </div>
    </div>
</div>

<div class="modal" id="addTask">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить новое задание </h4>
        </div>
      	<form method="POST" enctype="multipart/form-data" action="/adm/cases/{{$case->id}}/add_task">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Постановка задачи</label>
                            <textarea  name="task" class="form-control summernote" rows="5"></textarea>
	                    	<small class="form-text text-muted">Сформулируйте задание</small>
                		</div>
					</div>
				</div>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Добавить</button>
	        </div>
	    </form>
      </div>
    </div>
</div>

<div class="modal" id="edit_task_modal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Редактирование задания</h4>
        </div>     
        	<div class="modal-body">
				<p></p>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>	         
	        </div>
	    </form>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $('.summernote').summernote({height: '250px'});
    });
</script>

<script type="text/javascript">
    $('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
	$('.datatables-demo').dataTable();
    function delete_task(task,name)
	{
		Swal.fire({
			title: 'Удалить задание № '+name+'?',
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
			$('#t_'+task).submit();
  		}
		})
	}
</script>


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@if (\Session::has('success_task'))
    <script>
        $('a[href="#tasks"]').tab('show')
        toastr.success('{!! \Session::get('success_task') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@if (\Session::has('success_file'))
    <script>
        $('a[href="#files"]').tab('show')
        toastr.success('{!! \Session::get('success_file') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection

