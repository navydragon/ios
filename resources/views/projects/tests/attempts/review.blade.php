@extends('layouts.app')

@section('content')
<section>

<div class="container">
		<div class="col-md-9">
			<h3>{{$ta->test->name}}</h3>
			<table class="table table-striped">
				<tr><td><strong>Тест начат:</strong></td><td> {{\Carbon\Carbon::createFromTimeStamp(strtotime($ta->created_at))->format('d.m.y H:i:s')}}</td></tr>
				<tr><td><strong>Завершен:</strong></td><td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($ta->updated_at))->format('d.m.y H:i:s')}}</td></tr>
				<tr><td><strong>Результат:</strong></td><td>{{$ta->result == 1 ? "Пройден" : "Не пройден"}} ({{$ta->score}} / {{count($qs)}})</td></tr>
			</table>
			<hr>
			@php $n = 1; @endphp
			@foreach($qs as $question)
			<div class="row">
				<div class="col-md-2 alert  alert-default margin-bottom-30" id="q{{$n}}">
					<p><strong>Вопрос № {{$n}}</strong></p>
					<p>{{$question->is_right($ta->id) == true ? "Верно" : "Неверно" }}</p>
				</div>
				
				<div class="col-md-9 alert alert-info alert-mini text-dark ml-10"><strong>{{$question->name}}</strong>
				@if ($question->type_id == 1)
					<p class="mb-1">Выберите один  ответ:</p>
					@foreach ($question->answers as $answer)
						@php $cl = ""; @endphp
						@if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 1) )
							@php $cl = "bg-success"; @endphp
						@endif
						@if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 0) )
							@php $cl = "bg-danger"; @endphp
						@endif
						<div class="{{$cl}}">
						<label class="radio mb-0">
							<input type="radio" disabled name="questions[{{$question->id}}]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }} > <i></i> {{$answer->name}} 
							
						</label>
						</div>
					@endforeach
				@endif
				@if ($question->type_id == 2)
					<p class="mb-1">Выберите один или несколько ответов:</p>
					@foreach ($question->answers as $answer)
						@php $cl = ""; @endphp
						@if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 1) )
							@php $cl = "bg-success"; @endphp
						@endif
						@if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 0) )
							@php $cl = "bg-danger"; @endphp
						@endif
						<div class="{{$cl}}">
						<label class="checkbox mb-0">
							<input type="checkbox" disabled name="questions[{{$question->id}}][]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }}> <i></i> {{$answer->name}} 
						</label>

						</div>
					@endforeach
				@endif

				</div>
			</div>
			@php $n++; @endphp
			@endforeach
			<div class="row">
				<div class="col-md-12 text-center">
					<a class="btn btn-primary" href="/events/{{$ta->event->id}}">Закончить обзор</a>
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
					@foreach($qs as $question)
					@php $n++;@endphp
					<a href="#q{{$n}}" class="btn btn-default radius-0 relative">
						@if ($question->is_right($ta->id))
						<span class="badge badge-green btn-xs badge-corner radius-3"><i class="fa fa-plus"></i></span>
						@else
						<span class="badge badge-red btn-xs badge-corner radius-3"><i class="fa fa-minus"></i></span>
						@endif
						{{$n}} 
					</a>
					@endforeach
					<div class="col-md-12 text-center mt-10">
						<a href="/events/{{$ta->event->id}}">Закончить обзор...</a>
					</div>
				</div>
			</div>
		</div>

		
</div>
</section>
@endsection