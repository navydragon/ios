<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Просмотр результатов  мероприятия</h4>
</div>

<div class="modal-body">
  <h5>Тест: {{$test->name}}</h5>
  
  <h5>Пользователь: {{$user->name}}</h5>
  
  <hr> 
  <h5>Последняя попытка</h5>
  <p>Дата и время начала попытки: {{\Carbon\Carbon::createFromTimeStamp(strtotime($last_attempt->created_at))->format('d.m.y H:i:s')}}</p>
  <p>Дата и время завершения попытки: {{\Carbon\Carbon::createFromTimeStamp(strtotime($last_attempt->updated_at))->format('d.m.y H:i:s')}}</p>
  <p>Результат: 
    @if ($last_attempt->result == true) 
        Пройдено
    @else 
        Не пройдено
    @endif
  </p>
  <p>Набрано баллов: {{$last_attempt->score}} / {{$ep->show_questions}}</p> 
  <div>
    <h5>Ответы в последней попытке:</h5> 
    @php $n = 1; @endphp
			@foreach($last_attempt->test->questions as $question)
			<div class="row">
				<div class="col-md-2 alert  alert-default margin-bottom-30" id="q{{$n}}">
					<p><strong>Вопрос № {{$n}}</strong></p>
					<p>{{$question->is_right($last_attempt->id) == true ? "Верно" : "Неверно" }}</p>
				</div>
				
				<div class="col-md-9 alert alert-info alert-mini text-dark ml-10"><strong>{{$question->name}}</strong>
				@if ($question->type_id == 1)
					<p class="mb-1">Выберите один  ответ:</p>
					@foreach ($question->answers as $answer)
						@php $cl = ""; @endphp
						@if ( ($answer->is_chosen($last_attempt->id) == 1) && ($answer->right == 1) )
							@php $cl = "bg-success"; @endphp
						@endif
						@if ( ($answer->is_chosen($last_attempt->id) == 1) && ($answer->right == 0) )
							@php $cl = "bg-danger"; @endphp
						@endif
						<div class="{{$cl}}">
						<label class="radio mb-0">
							<input type="radio" disabled name="questions[{{$question->id}}]" value="{{$answer->id}}" {{$answer->is_chosen($last_attempt->id) == true ? "checked" : "" }} > <i></i> {{$answer->name}} 
							
						</label>
						</div>
					@endforeach
				@endif
				@if ($question->type_id == 2)
					<p class="mb-1">Выберите один или несколько ответов:</p>
					@foreach ($question->answers as $answer)
						@php $cl = ""; @endphp
						@if ( ($answer->is_chosen($last_attempt->id) == 1) && ($answer->right == 1) )
							@php $cl = "bg-success"; @endphp
						@endif
						@if ( ($answer->is_chosen($last_attempt->id) == 1) && ($answer->right == 0) )
							@php $cl = "bg-danger"; @endphp
						@endif
						<div class="{{$cl}}">
						<label class="checkbox mb-0">
							<input type="checkbox" disabled name="questions[{{$question->id}}][]" value="{{$answer->id}}" {{$answer->is_chosen($last_attempt->id) == true ? "checked" : "" }}> <i></i> {{$answer->name}} 
						</label>

						</div>
					@endforeach
				@endif

				</div>
			</div>
			@php $n++; @endphp
			@endforeach
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Закрыть</a>
    <a href="#"  class="btn btn-primary">Экспорт</a>   
</div>
