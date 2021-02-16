@extends('layouts.app')

@section('content')
<div style="padding: 20px; min-height: 93vh;">
    <div class="container">
        <div class="webinar__header">
            <img class="webinar__img" src="/images/accordeon-video.png" alt="">
            <div class="webinar">
                <h3 class="webinar__title">Вебинар {{$webinar->name}}</h3>
                <p class="webinar__subtitle">{!! $webinar->description !!}</p>
            </div>
        </div>

        <p class="webinar__date">Дата и время проведения:</p>


        <div class="webinar__date-container">
            <img class="session__img" src="/images/session-data.png" alt="">
            <p class="session__date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.Y H:i')}}</p>
        </div>
        

        <div>
            @if ($type == 'planned')
                <a class="webinar__btn" href="/webinars/{{$webinar->id}}/go">Войти на вебинар</a>
            @elseif ($webinar->recording_url != '')
                <a class="webinar__btn" href="/webinars/{{$webinar->id}}/view">Просмотреть запись</a
            @else
                <span>Запись недоступна</span>
            @endif
        </div>
    </div>
</div>

@endsection