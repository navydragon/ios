@extends('layouts.layout-1')


@section('header')
	Заявка "{{$ticket->name}}"
@endsection

@section('content')
	<p><a href="/adm/tickets" class="btn btn-default" >Назад</a></p>
		<div class="card">
			<div class="card-header">
            	<h4 class="mb-1">Информация о заявке</h4>	
            </div>
            <div class="card-body">
            	<label class="form-label form-label-lg ">Описание заявки</label>
            	<div>
            		{!! $ticket->description !!}
            	</div>
            	<label class="form-label form-label-lg ">Загруженные файлы</label>
            	<table class="table">
            		<thead>
            			<tr>
            				<th>Файл</th>
            				<th>Загрузил</th>
            				<th>Дата загрузки</th>
            			</tr>
            		</thead>
            		<tbody>

            			@if ($ticket->files()->count() == 0)
            			<tr>
            				<td colspan="3"><em>Нет загруженных файлов</em></td>
            			</tr>
            			@else
	            			@foreach ($ticket->files as $file)
	            				<tr>
	            					<td><a href="{!!  URL('/storage'.$file->source->path)  !!}" target="_blank">{{$file->source->title}}</a></td>
	            					<td>{{$file->source->author->name}}</td>
                                    <td>{{$file->load_date()}}</td>
	            				</tr>
	            			@endforeach
            			@endif
            		</tbody>
            	</table>
                <p><a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить файлы</a></p>
            </div>
		</div>


<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить файлы к заявке</h4>
        </div>
      	<form method="POST" autocomplete="off" action="/adm/tickets/{{$ticket->id}}/add_files" enctype="multipart/form-data">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
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