@extends('layouts.layout-1')



@section('header')
	{{$survey->name}} 
@endsection


@section('content')
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/surveys" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#questions">Вопросы анкеты</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <form action="/adm/surveys/{{$survey->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label form-label-lg">Название</label>
                    <input type="text" class="form-control" value="{{$survey->name}}" placeholder="" name="name" required="">
                </div>
                <div class="form-group">
                    <label class="form-label form-label-lg">Описание</label>
                    <textarea class="form-control" placeholder=""  rows="5" name="description">{{$survey->description}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="questions">
            <div class="card-body">
            <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить вопрос</a>
            <p></p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td >Текст вопроса</td>
                        <td>Порядок отображения</td>
                        <td style="width:30%">Действия</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{$question->id}}</td>
                        <td>{{$question->body}}</td>
                        <td>{{$question->sort}}</td>
                        <td>
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Действия
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if ($question->sort != 1)
                                <a href="/adm/surveys/{{$survey->id}}/questions/{{$question->id}}/move_up" class="dropdown-item"><i class="fa fa-arrow-up"></i> Поднять выше</a> 
                            @endif
                            @if ($question->sort != $questions->count())
                                <a href="/adm/surveys/{{$survey->id}}/questions/{{$question->id}}/move_down" class="dropdown-item"><i class="fa fa-arrow-down"></i> Опустить ниже</a>
                            @endif                        
                            <a href="#" data-remote="/adm/surveys/{{$survey->id}}/edit_question/{{$question->id}}"  data-toggle="modal"  data-target="#edit_question_modal"  class="dropdown-item"><i class="fa fa-edit"></i> Редактировать</a> 
                            <form method="POST" id="q_{{$question->id}}" action="/adm/surveys/{{$survey->id}}/questions/{{$question->id}}">
                                    @csrf {{ method_field('DELETE') }}
                                    <a class="dropdown-item" href="#" onclick="delete_question('{{$question->id}}','{{$question->body}}')"><i class="fas fa-trash"></i> Удалить</a>
                            </form>   
                        </div>
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
          <h4 class="modal-title">Добавить новый вопрос анкеты</h4>
        </div>
      	<form method="POST" action="/adm/surveys/{{$survey->id}}/store_question">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Текст вопроса:</label>
							<input type="text" class="form-control" name="body" placeholder="" required />
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

<div class="modal" id="edit_question_modal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Редактирование вопроса анкеты</h4>
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
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });

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

@if (\Session::has('success_delete'))
    <script>
        toastr.success('{!! \Session::get('success_delete') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

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