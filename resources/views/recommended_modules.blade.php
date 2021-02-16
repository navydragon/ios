@extends('layouts.app')

@section('content')
<div style="min-height: calc(100vh - 168px);">
    <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/session-vnutr.png" alt="">
                <h1 class="session__title">Методические материалы</h1>
            </div>
            <p>по вопросам охраны труда и безопасности производственных процессов, рекомендованные для изучения</p>

        </div>
    </section>
    <div class="container" style="margin-top: 30px;">
        @foreach ($modules as $module)
        <ul class="kn-material__container">
            <li class="kn-material__item">
                <img class="kn-material__item-img" src="/images/accordeon-metod.png" alt="">
                <div class="kn-material__info">
                    <h3 class="kn-material__item-name">{{$module->name}}</h3>
                    <!-- <span class="kn-material__item-category">Травма полученная при падении с высоты при проведении работ по завешиванию заземляюшей штанги</span>
                    <ul class="kn-material__tags-container">
                        <li class="kn-material__tag">Электромонтеры</li>
                        <li class="kn-material__tag">Работники пути</li>
                    </ul> -->
                </div>
                <a href="/storage/modules/{{$module->id}}/{{$module->path}}" target="_blank" class="kn-material__button">Просмотреть</a>
            </li>
        </ul>
        @endforeach
    </div>

</div>
@endsection
