@extends('layouts.layout-1')



@section('header')
	{{$task->name}} 
@endsection


@section('content')
    <div class="nav-tabs-top">
        <ul class="nav nav-tabs">
            <li>
                <a href="/adm/tasks" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#files">Дополнительные файлы</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="data">
                <div class="card-body">
                    <form action="/adm/tasks/{{$task->id}}" method="POST">
                        @csrf
                        <h3>Основные параметры</h3>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Название</label>
                            <input type="text" class="form-control" value="{{$task->name}}" placeholder="" name="name" required="">
                        </div>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Описание</label>
                            <textarea class="form-control" placeholder=""  rows="5" name="description">{!! $task->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label form-label-lg">Текст задания</label>
                            <textarea  name="text" class="form-control summernote" rows="10">{!! $task->text !!}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="files">
                <div class="card-body">
                    <h3>Дополнительные файлы</h3>
                    <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить файл</a>
                    <p></p>
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($task->files as $file)
                            @php $source = $file->source; @endphp
                            <tr>
                                <td><a href="/{{$source->path}}" target="_blank">{{$source->title}}</a></td>
                                <td>
                                    <form action="/adm/task_files/{{$file->id}}/delete" id="f_{{$file->id}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                        <!-- <a href="#" class="btn btn-sm btn-default"><i class="fa fa-arrow-up"></i></a> 
                                        <a href="#" class="btn btn-sm btn-default"><i class="fa fa-arrow-down"></i></a> -->
                                        <button type="button" onclick="delete_file('{{$file->id}}','{{$file->title}}')" class="btn btn-sm btn-danger"/><i class="fa fa-trash"></i> Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
      	<form method="POST" enctype="multipart/form-data" action="/adm/tasks/{{$task->id}}/add_file">
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

@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $('.summernote').summernote({height: '300px'});
    });

    function delete_file(file,name)
	{
		Swal.fire({
			title: 'Удалить файл '+name+'?',
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
			$('#f_'+file).submit();
  		}
		})
	}
</script>


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@if (\Session::has('success_file'))
    <script>
         $('a[href="#files"]').tab('show')
        toastr.success('{!! \Session::get('success_file') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection