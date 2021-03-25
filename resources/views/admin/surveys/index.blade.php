@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>Типы мероприятий</li>
	<li>Анкеты</li>
@endsection

@section('header')
	Анкеты
@endsection



@section('content')
<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered datatables-demo">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Кол-во вопросов</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surveys as $survey)
                @if (Auth::user()->admin_access($survey->author->filial_id))
                    <tr>
                    <td>{{$survey->id}}</td>
                    <td>{{$survey->name}}</td>
                    <td>{{$survey->description}}</td>
                    <td>{{$survey->questions()->count()}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Действия
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/adm/surveys/{{$survey->id}}"><i class="fas fa-eye"></i> Просмотреть</a>
                                <a class="dropdown-item" href="/adm/surveys/{{$survey->id}}/edit"><i class="fas fa-edit"></i> Редактировать</a>
                                <form method="POST" id="s_{{$survey->id}}" action="/adm/surveys/{{$survey->id}}">
					            @csrf {{ method_field('DELETE') }}
                                <a class="dropdown-item" href="#" onclick="delete_survey('{{$survey->id}}','{{$survey->name}}')"><i class="fas fa-trash"></i> Удалить</a>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Создать новую анкету</h4>
        </div>
      	<form method="POST" action="/adm/surveys">
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
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-body').load($(this).data("remote"));
    }); 
</script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();
    function delete_survey(survey,name)
	{
		Swal.fire({
			title: 'Удалить анкету '+name+'?',
			text: 'Все вопросы данной анкеты, а также результаты ее прохождения будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#s_'+survey).submit();
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