@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>Орг. структура</li>
	<li>Филиалы</li>
@endsection

@section('header')
	Филиалы
@endsection


@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{mix('/vendor/libs/toastr/toastr.css')}}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/sweetalert2/sweetalert2.css') }}">
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
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($filials as $filial)
					<tr>
					<td>{{$filial->id}}</td>
					<td>{{$filial->name}}</td>
					<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действия
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="/adm/filials/{{$filial->id}}"  class="dropdown-item"><span class="fas fa-eye"  ></span> Просмотреть</a> 
						<a href="/adm/filials/{{$filial->id}}/edit" class="dropdown-item"><span class="fas fa-edit"></span> Редактировать</a> 
						<form method="POST" id="df_{{$filial->id}}" action="/adm/filials/{{$filial->id}}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="button" onclick="delete_filial('{{$filial->id}}','{{$filial->name}}')" class="dropdown-item"><i class="fa fa-times"></i> Удалить филиал</button>
                        </form>
                    </div>


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
          <h4 class="modal-title">Добавить филиал</h4>
        </div>
      	<form method="POST" action="/adm/filials">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
					</div>
                    <div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Краткое название</label>
                    		<input type="text" class="form-control " placeholder="" name="shortname" required="">
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
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ mix('/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{mix('/vendor/libs/toastr/toastr.js')}}"></script>
<script type="text/javascript">
	$('.datatables-demo').dataTable();
    function delete_filial(filial,name)
	{
		Swal.fire({
			title: 'Удалить филиал '+name+'?',
			text: 'Пользователи, прикрепленные к данному филиалу будут откреплены, но не удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#df_'+filial).submit();
  		}
		})
	}

    @if (\Session::has('success_store'))
        toastr.success('{!! \Session::get('success_store') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    @endif
    @if (\Session::has('success_delete'))
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    @endif
</script>
@endsection

