@extends('layouts.layout-1')


@section('header')
	Пользователи ИОС
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection


@section('content')
<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
<div class="card">
    <div class="card-body">
		<table class="table table-bordered datatables-demo">
			<thead style="background-color: #333333; color: #fff;">
				<tr>
					<th>ID</th>
					<th>Ф.И.О.</th>
					<th>Филиал</th>
					<th>Должность</th>
					<th>Контакты</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->filial ? $user->filial->name : ""}}</td>
					<td>{{$user->job}}</td>
					<td>{{$user->email}}<br>{{$user->phone}}</td>
					<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действия
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/adm/users/{{$user->id}}"><i class="fas fa-eye"></i> Просмотреть</a>
                        <a class="dropdown-item" href="/adm/users/{{$user->id}}/edit"><i class="fas fa-edit"></i> Редактировать</a>
                        <form method="POST" id="u_{{$user->id}}" action="/adm/users/{{$user->id}}">
					        @csrf {{ method_field('DELETE') }}
                            <a class="dropdown-item" href="#" onclick="delete_user('{{$user->id}}','{{$user->name}}')"><i class="fas fa-trash"></i> Удалить</a>
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
          <h4 class="modal-title">Создать нового пользователя</h4>
        </div>
      	<form method="POST" action="/adm/tests">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
                    <form method="POST" action="/adm/users/{{$user->id}}/update">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">ID</label>
                        <div class="col-sm-10">
                            {{$user->id}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" required>Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastname" class="form-control" placeholder="Фамилия" value="{{$user->lastname}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" >Имя</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstname" class="form-control" value="{{$user->firstname}}" placeholder="Имя" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Отчество</label>
                        <div class="col-sm-10">
                            <input type="text" name="middlename" class="form-control" value="{{$user->middlename}}" placeholder="Отчество" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">E-mail (логин для входа)</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="E-mail" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Контактный телефон</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Телефон" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Филиал ОАО «РЖД»</label>
                        <div class="col-sm-10">
                            <select id="filial_id"  name="filial_id" value="" class="custom-select form-control" required >
                                <option selected value="">Не выбрано</option> 
                                @foreach($filials as $filial)
                                    <option value="{{$filial->id}}">{{$filial->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Подразделение</label>
                        <div class="col-sm-10">
                            <input type="text" name="division" class="form-control" value="{{$user->division}}" placeholder="Подразделение" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Должность</label>
                        <div class="col-sm-10">
                            <input type="text" name="job" class="form-control" value="{{$user->job}}" placeholder="Должность" required>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    </div>
                </form>
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
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();
    function delete_user(user,name)
	{
		Swal.fire({
			title: 'Удалить пользователя '+name+'?',
			text: 'Все результаты работы данного пользователя в системе будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#u_'+user).submit();
  		}
		})
	}

</script>
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-body').load($(this).data("remote"));
    }); 
</script>

@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection