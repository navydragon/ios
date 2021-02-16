@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>Типы мероприятий</li>
	<li>Кейсы</li>
@endsection

@section('header')
    Кейсы
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
                    <th>Автор</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                    <tr>
                    <td>{{$case->id}}</td>
                    <td>{{$case->name}}</td>
                    <td>{{$case->author->name}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Действия
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/adm/cases/{{$case->id}}"><i class="fas fa-eye"></i> Просмотреть</a>
                                <a class="dropdown-item" href="/adm/cases/{{$case->id}}/edit"><i class="fas fa-edit"></i> Редактировать</a>
                                <form method="POST" id="c_{{$case->id}}" action="/adm/cases/{{$case->id}}">
					            @csrf {{ method_field('DELETE') }}
                                <a class="dropdown-item" href="#" onclick="delete_case('{{$case->id}}','{{$case->name}}')"><i class="fas fa-trash"></i> Удалить</a>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
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
          <h4 class="modal-title">Создать новый кейс</h4>
        </div>
      	<form method="POST" action="/adm/cases">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
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
    function delete_case(l_case,name)
	{
		Swal.fire({
			title: 'Удалить кейс '+name+'?',
			text: 'Все файлы данного кейса, а также результаты его прохождения будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#c_'+l_case).submit();
  		}
		})
	}
</script>


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection