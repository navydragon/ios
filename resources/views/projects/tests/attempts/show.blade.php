@extends('layouts.app')

@section('content')
<div class="container" style="padding: 50px 0px; min-height: 82vh;">
		<div class="col-md-9">
			<form method="POST" action="/events/{{$event->id}}/tests/attempts/{{$ta->id}}/summary">
			@csrf
            
            <div class="test__header">
                <img class="test__img" src="/images/accordeon-test.png" alt="">
                <div class="test__info">
                    <h3 class="test__title">{{$ta->test->name}}</h3>
                    <p class="test__subtitle">Для навигации по тесту используйте меню справа</p>
                </div>
            </div>
			<hr>
            @php $n = 1; 
            //$ep = $event->event_parameter;
            //$qs = $ta->attempt_results()->get();
            //$type = 'exist';
            //if (count($qs) == 0)
            //{
            //    $type = 'new';
            //    $qs = $ta->test->questions_in_test($ep->show_questions);
           // }
            @endphp
                    @foreach($qs as $question)
                    <div class="row">
                        <div class="col-md-2 alert  alert-default margin-bottom-30" id="q{{$n}}">Вопрос № {{$n}}</div>
                        
                        <div class="col-md-9 alert alert-mini text-dark ml-10"><strong>{{$question->name}}</strong>
                        @if ($question->type_id == 1)
                            <p class="mb-1">Выберите один  ответ:</p>
                            @foreach ($question->answers as $answer)
                                <label class="radio">
                                    <input type="radio" name="questions[{{$question->id}}]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }} > <i></i> {{$answer->name}} 
                                </label><br>
                            @endforeach
                        @endif
                        @if ($question->type_id == 2)
                            <p class="mb-1">Выберите один или несколько ответов:</p>
                            @foreach ($question->answers as $answer)
                                <label class="checkbox">
                                    <input type="checkbox" name="questions[{{$question->id}}][]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }}> <i></i> {{$answer->name}} 
                                </label><br>
                            @endforeach
                        @endif

                        </div>
                    </div>
                    @php $n++; @endphp
                    @endforeach

			<div class="row">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Закончить попытку...</button>
				</div>
			</div>
			</form>
		</div>
        
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Навигация по тесту</h2>
				</div>
				<div class="panel-body">
					@php $n=0;@endphp

                        @foreach($qs  as $question)
                        @php $n++;@endphp
                        <a href="#q{{$n}}" class="btn btn-default radius-0 relative" style="margin-bottom: 5px;">
                            @if ($question->is_answered($ta->id))
                            <span class="badge badge-dark-blue btn-xs badge-corner radius-3"><i class="fa fa-check"></i></span>
                            @endif
                            {{$n}} 
                        </a>
                        @endforeach

					
				</div>
			</div>
		</div>

		
</div>
@endsection