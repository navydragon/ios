@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>Типы мероприятий</li>
	<li>Вебинары</li>
@endsection

@section('header')
	Вебинары
@endsection

@section('content')
<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered datatables-demo">
            <thead style="background-color: #333333; color: #fff;">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Дата проведения</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($webinars as $webinar)
                @if (Auth::user()->admin_access($webinar->author->filial_id))
                    <tr>
                    <td>{{$webinar->id}}</td>
                    <td>{{$webinar->name}}</td>
                    <td>{{$webinar->description}}</td>
                    <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.Y H:i:s')}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Действия
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/adm/webinars/{{$webinar->id}}"><i class="fas fa-eye"></i> Просмотреть</a>
                                <a class="dropdown-item" href="/adm/webinars/{{$webinar->id}}/edit"><i class="fas fa-edit"></i> Редактировать</a>
                                <form method="POST" id="w_{{$webinar->id}}" action="/adm/webinars/{{$webinar->id}}">
					            @csrf {{ method_field('DELETE') }}
                                <a class="dropdown-item" href="#" onclick="delete_webinar('{{$webinar->id}}','{{$webinar->name}}')"><i class="fas fa-trash"></i> Удалить</a>
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
          <h4 class="modal-title">Создать новый вебинар</h4>
        </div>
      	<form method="POST" action="/adm/webinars">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
                        <div class="form-group">
                    		<label class="form-label form-label-lg">Дата и время проведения</label>
                    		<input type="datetime-local" class="form-control" placeholder="" name="start_date" required="">
                		</div>
						<div class="form-group">
							<label class="form-label form-label-lg">Описание (необязательно):</label>
							<textarea class="form-control" placeholder="" rows="2" name="description"></textarea>
						</div>
                        <div class="form-group">
                    		<label class="form-label form-label-lg">Ссылка на вход для участников</label>
                    		<input type="text" class="form-control " placeholder="" name="url" required="">
                		</div>
                        <div class="form-group">
                    		<label class="form-label form-label-lg">Ссылка на вход для организатора/ведущего (не обязательно)</label>
                    		<input type="text" class="form-control " placeholder="" name="admin_url">
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


    function delete_webinar(webinar,name)
	{
		Swal.fire({
			title: 'Удалить вебинар '+name+'?',
			text: 'Все результаты данного вебинара также будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#w_'+webinar).submit();
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