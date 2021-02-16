@extends('layouts.layout-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();

</script>
@endsection

@section('header')
	Заявки
@endsection

@section('content')
	<p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Создать</a></p>
		<div class="card">
		<div class="card-datatable table-responsive">
			<table id="dt_basic" class="table datatables-demo table-striped table-bordered table-hover" width="100%">
				<thead>			                
					<tr class="table-primary">
						<th>ID</th>
						<th>Название</th>
						<th>Тип</th>
						<th>Автор</th>
						<th>Дата создания</th>
						<th>Статус</th>
						<th>Действия</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tickets as $ticket)
					<tr>
						<td>{{$ticket->id}}</td>
						<td>{{$ticket->name}}</td>
						<td>
							<span class="badge {{$ticket->get_badge_class()}}">{{$ticket->type->name}}</span>
						</td>
						<td>{{$ticket->author->name}}</td>
						<td>{{$ticket->created_at}}</td>
						<td>
							@switch($ticket->status)
							    @case(1)
							        <span>В процессе</span>
							        @break

							    @case(2)
							        <span>Выполнена</span>
							        @break
							    @case(3)
							    	<span>Закрыта</span>
							    @default
							        <span>Ошибка!</span>
							@endswitch
						</td>
						<td>
							<a href="/adm/tickets/{{$ticket->id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Просмотреть</a>
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
          <h4 class="modal-title">Создать новую заявку</h4>
        </div>
      	<form method="POST" autocomplete="off" action="/adm/tickets" enctype="multipart/form-data">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Тип заявки</label>
                    		<select class="custom-select custom-select-lg" name="type">
				                <option selected="">Выберите тип заявки</option>
				                @foreach ($ticket_types as $type)
				                	<option value="{{$type->id}}">{{$type->name}}</option>
				                @endforeach
				            </select>
                		</div>
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
						<div class="form-group">
							<label class="form-label form-label-lg">Описание</label>
							<textarea class="form-control" placeholder="" rows="5" name="description" required=""></textarea>
						</div>
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Добавить файлы</label>
	                   		<input name="files" multiple="" type="file">
	                    	<small class="form-text text-muted">Выберите один или несколько файлов.</small>
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
