@extends('layouts.app')

@section('content')
<section>
<div class="container">
		<div class="col-md-9">
			<form method="POST" action="/events/{{$event->id}}/tests/attempts/{{$ta->id}}/save">
			@csrf
			<h3>{{$ta->test->name}}</h3>
			<table class="table table-striped table-bordered">
				<thead>
				<tr class="table-primary">
					<th class="text-center">Вопрос</th>
					<th class="text-center">Состояние</th>
				</tr>
				</thead>
			@php $n = 1; @endphp
			<tbody>
			@foreach($qs as $question)
				<tr>
					<td class="text-center">{{$n}}</td>
					<td class="text-center">
						@if ($question->is_answered($ta->id))
							Ответ сохранен
						@else
							Пока нет ответа
						@endif
					</td>
				</tr>
				
			@php $n++; @endphp
			@endforeach
			</tbody>
			</table>
			<div class="row">
				<div class="col-md-6 text-center">
					<a href="/events/{{$event->id}}/tests/attempts/{{$ta->id}}" class="btn btn-info">Вернуться к прохождению</a>
				</div>
				<div class="col-md-6 text-center">
					<button type="submit" class="btn btn-primary">Отправить все и завершить тест</button>
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
</section>
@endsection