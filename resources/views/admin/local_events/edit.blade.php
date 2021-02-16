@extends('layouts.layout-1')



@section('header')
  Редактирование	локального мероприятия «{{$ev->name}}» 
@endsection


@section('content')
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/local_events" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
              <form action="/adm/local_events/{{$event->id}}" method="POST">
                @csrf
                <div class="form-group">
                  <h5>Название</h5>
                  <div>{{$ev->name}}</div>
                </div>
                <div class="form-group">
                  <h5>Тип</h5>
                  <div>{{$ev->type}}</div>
                </div>
                <hr>
                <div class="form-group">
                  <h5>Дата, до которой открыто мероприятие</h5>
                  <input type="date" class="form-control" name="max_date" value="{{\Carbon\Carbon::createFromTimeStamp(strtotime($ep->max_date))->format('Y-m-d')}}" required/>
                </div>
                @if ($event->event_type_id == 3)
                  <div class="form-group">
                    <h5>Количество вопросов в тесте</h5>
                    <input type="number" min="1" class="form-control" name="show_questions" value="{{$ep->show_questions}}" required />
                  </div>
                  <div class="form-group">
                    <h5>Количество вопросов для зачета</h5>
                    <input type="number" min="1" class="form-control" name="passing_score" value="{{$ep->passing_score}}" required />
                    
                  </div>
                  <div class="form-group">
                    <h5>Максимальное количество попыток</h5>
                    <input type="number" min="1" class="form-control" name="max_attempts" value="{{$ep->max_attempts}}" required />
                  </div>
                  <div class="form-group">
                    <h5>Время на одну попытку (минут)</h5>
                    <input type="number" min="1" class="form-control" name="attempt_time" value="{{$ep->attempt_time}}" required />
                  </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
                </div>
              </form>
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



@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@endsection