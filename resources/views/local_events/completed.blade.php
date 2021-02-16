@extends('layouts.app')

@section('content')

<div class="" style="min-height: 93vh;">
<section class="page-header dark page-header-xs">
    <div class="container">
        <div class="session__header">
            <img class="session__img" src="/images/session-vnutr.png" alt="">
            <h1 class="session__title">Мероприятия</h1>
        </div>
        <p>проводятся для обучения по локальным обучающим элементам по охране труда</p>

        <!-- page tabs -->
        <ul class="page-header-tabs list-inline">
            <li><a href="/local_events">Текущие</a></li>
            <li class="active"><a href="/local_events/completed">Прошедшие</a></li>
        </ul><!-- /page tabs -->

    </div>
</section>

<div class="container">
    <p class="session__tabs-description">Завершенные или пройденные мероприятия доступны только для просмотра.</p>
</div>

<ul class="accordeon__container container">
    @foreach($events as $event)
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
            @if (isset($event->event_results->first()->is_passed))
            <div class="accordeon__item-type"></div>
            @endif
            @if ($event->event_result(Auth::user()->id)->count() != 0)
                <a href="#" data-toggle="modal" data-remote="/events/{{$event->id}}/results/{{Auth::user()->id}}"  data-target="#myModal" class="accordeon__item-button margin-right-10">Результаты</a>
            @endif
        <div>
    </li>
    @endforeach
</ul>


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