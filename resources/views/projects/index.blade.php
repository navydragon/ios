@extends('layouts.app')

@section('content')

<div class="" style="padding: 0px; min-height: 93vh;">
<section class="page-header dark page-header-xs">
    <div class="container">
        <div class="session__header">
            <img class="session__img" src="/images/session-vnutr.png" alt="">
            <h1 class="session__title">Оценочные сессии</h1>
        </div>
        <p>проводятся для обучения и оценки знаний участников по выбранной тематике в области охраны труда</p>

        <!-- page tabs -->
        <ul class="page-header-tabs list-inline">
            <li class="active"><a href="/projects">Текущие</a></li>
            <li><a href="/projects/completed">Прошедшие</a></li>
            <!-- <li><a href="portfolio-grid-2-columns-nogutter.html">Предстоящие</a></li> -->
        </ul><!-- /page tabs -->

    </div>
</section>

<div class="container">
@if ($active_projects->count() == 0)
<div class="alert alert-info margin-bottom-30 margin-top-30"><!-- INFO -->
    <i class="fa fa-info"></i>
    На текущий момент не планируются к проведению какие-либо оценочные сессии.
</div>
@else
<p class="session__tabs-description">Ниже отображается список текущих оценочных сессий. Для просмотра этапов и мероприятий, нажмите на кнопку "Присоединиться/Войти"</p>
@endif
</div>

@foreach($active_projects as $project)

<section class="session__item container">
<div class="session__info">
    <h3 class="session__info-title">{{$project->name}}</h3>
    <div class="session__host">
        <p class="session__host-name"><img class="session__img" src="/images/session-name.png" alt="">{{$project->author->name}}</p>
        <p class="session__host-location"><img class="session__img" src="/images/session-road.png" alt="">{{$project->author->filial->shortname}}</p>
    </div>
    <p class="session__description">{{$project->description}}</p>
    <div class="seccion__data">
        <p class="session__date"><img class="session__img" src="/images/session-data.png" alt="">{{\Carbon\Carbon::createFromTimeStamp(strtotime($project->start_date))->format('d.m.y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->end_date))->format('d.m.y')}}</p>
        <p class="session__type"><img class="session__img" src="/images/session-type.png" alt="">{{$project->type}}</p>
        <p class="session__location"><img class="session__img" src="/images/session-location.png" alt="">{{$project->location}}</p>
    </div>
</div>
@if ($project->hasUser(Auth::user()->id) == false)
    <a class="session__button btn-animated" href="/projects/{{$project->id}}/add_user/{{Auth::user()->id}}">Присоединиться</a>
@else
    <a class="session__button btn-animated" href="/projects/{{$project->id}}">Войти</a>
@endif

</section>

@endforeach
</div>
@endsection