@extends('layouts.layout-1')



@section('header')
	{{$test->name}} 
@endsection


@section('content')
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/tests" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#questions">Вопросы теста</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <form action="/adm/tests/{{$test->id}}" method="POST">
		        @csrf
                <div class="form-group">
                    <label class="form-label form-label-lg">Название</label>
                    <input type="text" class="form-control" value="{{$test->name}}" placeholder="" name="name" required="">
                </div>
                <div class="form-group">
                    <label class="form-label form-label-lg">Описание</label>
                    <textarea class="form-control" placeholder=""  rows="5" name="description">{{$test->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="questions">
            <div class="card-body">
                <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить вопрос</a>
                <p></p>
                <table class="table table-bordered datatables-demo">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="w-50" >Текст вопроса</th>
                            <th class="w-10">Тип вопроса</th>
                            <th class="w-25">Варианты ответов</th>
                            <th class="w-10">Действия</th>
                        </tr>
                    </thead>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{$question->sort}}</td>
                            <td>{{$question->name}}</td>
                            <td>{{$question->type->name}}</td>
                            <td>
                                @foreach ($question->answers as $answer)
                                    <li>
                                        {!! $answer->right == 1 ? "<strong>": ""!!}
                                            {{$answer->name}}
                                        {!! $answer->right == 1 ? "</strong>": "" !!}
                                    </li>
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Действия
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if ($question->sort != 1)
                                        <a href="/adm/tests/{{$test->id}}/questions/{{$question->id}}/move_up" class="dropdown-item"><i class="fa fa-arrow-up"></i> Поднять выше</a> 
                                    @endif
                                    @if ($question->sort != $questions->count())
                                        <a href="/adm/tests/{{$test->id}}/questions/{{$question->id}}/move_down" class="dropdown-item"><i class="fa fa-arrow-down"></i> Опустить ниже</a>
                                    @endif
                                    <a href="#" data-remote="/adm/tests/{{$test->id}}/edit_question/{{$question->id}}"  data-toggle="modal"  data-target="#edit_question_modal" class="dropdown-item"><i class="fa fa-edit"></i> Редактировать</a> 
                                    <form method="POST" id="q_{{$question->id}}" action="/adm/tests/{{$test->id}}/questions/{{$question->id}}">
                                        @csrf {{ method_field('DELETE') }}
                                        <a class="dropdown-item" href="#" onclick="delete_question('{{$question->id}}','{{$question->body}}')"><i class="fas fa-trash"></i> Удалить</a>
                                    </form>    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
	

	


			
<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить новый вопрос</h4>
        </div>
      	<form method="POST" action="/adm/tests/{{$test->id}}/store_question">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Текст вопроса:</label>
							<input type="text" class="form-control" name="name" placeholder="" required />
						</div>
						<div class="form-group">
							<label>Тип вопроса:</label>
							<select class="form-control" name="type" placeholder="" required />
							<option value="1" selected>Единичный выбор</option>
							<option value="2" >Множественный выбор</option>
							<option value="3" >Текстовый ввод</option>
							</select>
						</div>
						<div class="form-group">
							<h4>Варианты ответов</h4>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="80%">Текст ответа</th>
									<th>Правильность</th>
								</tr>
							</thead>
							<tbody>
								@for ($n=0; $n < 10; $n++)
								<tr>
									<td><input type="text" name="a_t[]" class="form-control"></td>
									<td class="text-center">
                						<input type="checkbox" class="form-control form-control-lg" name="a_r[{{$n}}]">
									</td>
								</tr>
				
								@endfor
							</tbody>
						</table>
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

<div class="modal" id="edit_question_modal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Редактирование вопроса </h4>
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


@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection


@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();
    function delete_question(question,name)
	{
		Swal.fire({
			title: 'Удалить вопрос '+name+'?',
			text: 'Все ответы пользователей на данный вопрос также будут удалены',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#FFF',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена'
			
		}).then((result) => {
		if (result.value) {
			$('#q_'+question).submit();
  		}
		})
	}
</script>
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    }); 
</script>


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@if (\Session::has('success_question'))
    <script>
         $('a[href="#questions"]').tab('show')
        toastr.success('{!! \Session::get('success_question') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection