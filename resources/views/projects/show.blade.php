@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 50px; min-height: 77vh;">

    <h2 class="accordeon__title">{{$project->name}}</h2>

    <div class="toggle toggle-transparent-body">
        @foreach($project->stages()->get() as $stage)
            <div class="toggle">
                <label class="accordeon__label">
                    <div class="accordeon__img-stage"></div>
                    <span class="accordeon__stage">{{$stage->name}}</span>
                    <div class="accordeon__img-type"></div>
                    <span class="accordeon__type">{{$stage->type ? $stage->type : 'Не определен'}}</span>
                    <div class="accordeon__img-date"></div>
                    <span class="accordeon__date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->start_date))->format('d.m.y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($stage->end_date))->format('d.m.y')}}</span>
                </label>
                <div class="toggle-content">
                    <p>{{$stage->description}}</p>
                    <h4 class="accordeon__tasks">Структура этапа</h4>
                    <ul class="accordeon__container">
                    @foreach($stage->events as $event)
                    @php $e_d = $event->description(); @endphp
                    <li class="accordeon__item">
                            <img class="accordeon__item-img" src="{{$e_d->icon}}" alt="">
                            <div class="accordeon__item-info">
                                <p class="accordeon__item-text">{{$e_d->name}}</p>
                                <ul class="kn-material__tags-container">
                                        <li class="kn-material__tag">{{$e_d->type}}</li>
                                        <span class="accordeon__item-date">Дата окончания:  {{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.Y')}}</span>
                                    </ul>
                            </div>
                            <div class="accordeon__item-progress">
                            @if ($event->is_passed(Auth::user()->id) == true)
                            <div class="accordeon__item-type"></div>
                            @endif
                                <a class="accordeon__item-button" href="/events/{{$event->id}}">Начать</a>
                            <div>
                    </li>
                    
                    @endforeach
                        
                        <!-- <li class="accordeon__item">
                            <img class="accordeon__item-img" src="/images/accordeon-keys.png" alt="">
                            <p class="accordeon__item-text">Кейс</p>
                            <div class="accordeon__item-type"></div>
                            <a class="accordeon__item-button" href="">Начать</a>
                        </li>
                        <li class="accordeon__item">
                            <img class="accordeon__item-img" src="/images/accordeon-other.png" alt="">
                            <p class="accordeon__item-text">Дополнительный материал</p>
                            <div class="accordeon__item-type"></div>
                            <a class="accordeon__item-button" href="">Начать</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        @endforeach
      
    </div>

</div>


<!--<div class="container">
	<h3></h3>

	@foreach($project->stages()->get() as $stage)

	<div class="panel panel-default">
		<div class="panel-heading">-->
		<!--	<a class="btn btn-danger btn-xs pull-right">Header Button</a>-->
			<!--<h2 class="panel-title">{{$stage->name}} ({{$stage->get_start_date()}}-{{$stage->get_end_date()}})</h2>
		</div>
		<div class="panel-body">
			<p>{{$stage->description}}</p>
			<div class="list-group">
			<h4>Задания:</h4>
			@foreach($stage->events as $event)
			@php $e_d = $event->description(); @endphp
			<a class="list-group-item" href="/projects/{{$project->id}}/events/{{$event->id}}/{{$e_d->sublink}}"><i class="{{$e_d->icon}} text-info ico-bordered"></i> {{$e_d->name}}</a>
			
			@endforeach
			</div>
		</div>
	</div>
	@endforeach-->


			
	
</div>
@endsection