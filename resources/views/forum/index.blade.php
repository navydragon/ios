@extends('layouts.app')

@section('content')

<div class="" style="padding: 0px; min-height: 93vh;">
    <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/interaction.png" alt="">
                <h1 class="session__title">Взаимодействие</h1>
            </div>
            <p>взаидодействие пользователей ИОС</p>

            <!-- page tabs -->
            <ul class="page-header-tabs list-inline">
                <li class="active"><a href="/forums">Форум</a></li>
                <li><a href="/webinars">Вебинары</a></li>
            </ul><!-- /page tabs -->

        </div>
    </section>

<div class="container" style="margin-top: 30px;">
	
    <table class="table table-vertical-middle margin-bottom-60">
        <thead>
            <tr class="size-15 table__header">
                <th class="table__header-item">РАЗДЕЛЫ ФОРУМА</th>
                <th class="text-center hidden-xs width-100 weight-300 table__header-item">ТЕМ</th>
                <th class="text-center hidden-xs width-100 weight-300 table__header-item">СООБЩЕНИЙ</th>
                <th class="text-center hidden-xs width-200 weight-300 table__header-item">ОБНОВЛЕНИЕ</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($forums as $forum)
            <tr>
                <td>
                    <h4 class="nomargin size-16 table__link">
                        <a href="forums/{{$forum->id}} table__link">
                            {{$forum->name}}
                        </a>


                    </h4>
                </td>
                <td class="text-center hidden-xs table__main">
                    {{$forum->threads->count()}}
                </td>
                <td class="text-center hidden-xs table__main">
                    {{$forum->messages->count()}}
                </td>
                <td class="hidden-xs text-center table__main">
                    {{\Carbon\Carbon::createFromTimeStamp(strtotime($forum->messages->last()->created_at))->format('d.m.Y')}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<!-- /FORUM 1 -->

</div>

</div>

@endsection