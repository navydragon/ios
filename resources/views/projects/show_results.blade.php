@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 50px; min-height: 77vh;">

    <h2 class="accordeon__title"><em>(завершено)</em> {{$project->name}}</h2>

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
                                    </ul>
                            </div>
                            <div class="accordeon__item-progress">
                            @if ($event->is_passed(Auth::user()->id) == true)
                            <div class="accordeon__item-type"></div>
                            @endif
                            @if ($event->event_result(Auth::user()->id)->count() != 0)
                                <a href="#" data-toggle="modal" data-remote="/events/{{$event->id}}/results/{{Auth::user()->id}}"  data-target="#myModal" class="accordeon__item-button">Результаты</a>
                            @endif
                            <div>
                    </li>
                    
                    @endforeach
                        
                    </ul>
                </div>
            </div>
        @endforeach
      
    </div>

</div>

</div>
<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Просмотр результатов локального мероприятия</h4>
        </div>
      </div>
    </div>
</div>
@endsection


@section ('scripts')
<script>
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
</script>
@endsection