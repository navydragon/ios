@extends('layouts.app')

@section('content')

<div style="padding: 0px; min-height: 93vh;">
    <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/interaction.png" alt="">
                <h1 class="session__title">Взаимодействие</h1>
            </div>
            <p>взаидодействие пользователей ИОС</p>

            <!-- page tabs -->
            <ul class="page-header-tabs list-inline">
                <li><a href="/forums">Форум</a></li>
                <li class="active"><a href="/webinars">Вебинары</a></li>
            </ul><!-- /page tabs -->
        </div>
    </section>

    <div class="container" style="margin-top: 30px;">
        <div class="toggle toggle-transparent-body">
            <div class="toggle active">
                <label class="accordeon__label">Планируемые вебинары</label>
                <div class="toggle-content">
                    <ul class="webinar__container">
                        @foreach ($planned_webinars as $webinar)
                        <li class="webinar__item">
                            <div class="webinar__date">
                                <p class="webinar__data">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.Y H:i')}}</p>
                                <p class="webinar__time">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->diffForHumans()}}</p>
                            </div>
                            <div class="webinar__info">
                                <h3 class="webinar__name">{{$webinar->name}}</h3>
                                <span class="webinar__status"><img class="webinar__status-img" src="/images/status.png" alt="">Запланирован</span>
                            </div>
                            <div class="webinar__buttons">
                                <a href="/webinars/{{$webinar->id}}" class="webinar__btn">Подробнее</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="toggle">
                <label class="accordeon__label">Прошедшие вебинары</label>
                <div class="toggle-content">
                        <ul class="webinar__container">
                            @foreach ($completed_webinars as $webinar)
                            <li class="webinar__item">
                                <div class="webinar__date">
                                    <p class="webinar__data">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.Y H:i')}}</p>
                                    <p class="webinar__time">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->diffForHumans()}}</p>
                                </div>
                                <div class="webinar__info">
                                    <h3 class="webinar__name">{{$webinar->name}}</h3>
                                    <span class="webinar__status"><img class="webinar__status-img" src="/images/status.png" alt="">Проведен</span>
                                </div>
                                <div class="webinar__buttons">
                                    <a href="/webinars/{{$webinar->id}}" class="webinar__btn">Подробнее</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>

</div>
</div>

@endsection