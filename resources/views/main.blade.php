@extends('layouts.app')

@section('content')


<section style="min-height: 93vh; padding: 30px 0px 40px;">
<div class="container">
    <h4 class="main-page__title">Добро пожаловать в Информационно-образовательную среду!</h4>
</div>

<section class="main-page__target">
    <div class="target container">
        <img class="target__img" src="/images/target.png" alt="">
        <div class="target__description">
            <h3 class="target__title"><span class="text-selected-red">Цель</span> Информационно-образовательной среды</h3>
            <p class="target__text">оценка качества профессиональной подготовки участников сессий в области охраны труда, знание ими нормативной документации, умение предлагать решения в возникающих профессиональных ситуациях</p>
        </div>
    </div>
</section>

<!-- Services -->
<section class="main-page__tasks">
    <div class="container">
        <!--
        LTR INFO: box-icon-left or box-icon-right - are the same on LTR
        -->
        <div class="row">
        <h4 style="padding-left: 15px"><span class="text-selected-red">Задачи</span> Информационно-образовательной среды</h4>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <a class="box-icon-title" href="/docs/metodika.pdf" target="_blank">
                        <i class="fa"><img src="/images/task-metodika.png" alt="" style="width: 20px; margin-top: -3px;"></i>
                        <h2>Методика</h2>
                    </a>
                    <p>предлагается универсальная методика и технология обучения для руководителей среднего звена в&nbsp;рамках модуля виртуальном классе по&nbsp;охране труда</p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <a class="box-icon-title" href="/docs/reglament.pdf" target="_blank">
                        <i class="fa"><img src="/images/task-reglament.png" alt="" style="width: 20px; margin-top: -3px;"></i>
                        <h2>Регламент</h2>
                    </a>
                    <p>универсальный регламент организации проведения оценочных сессий и локальных мероприятий по охране труда</p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <div class="box-icon-title">
                        <a class="box-icon-title" href="/recommended_modules">
                        <i class="fa"><img src="/images/task-material.png" alt="" style="width: 20px;"></i>
                        <h2>Материалы</h2>
                        </a>
                    </div>
                    <p>типовые методические материалы проведения оценочных сессий с&nbsp;использование новых инновационных образовательных технологий</p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <div class="box-icon-title" href="#">
                        <i class="fa"><img src="/images/task-webinar.png" alt="" style="width: 20px; margin-top: -3px;"></i>
                        <h2>Консультации</h2>
                    </div>
                    <p>технология проведения виртуальных консультационных семинаров (вебинаров)</p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <a class="box-icon-title" href="/recommended_cases">
                        <i class="fa fa-cubes"></i>
                        <h2>Рекомендованные кейсы</h2>
                    </a>
                    <p>для оценки профессиональных знаний в&nbsp;области охраны труда</p>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="box-icon box-icon-left">
                    <div class="box-icon-title" href="#">
                        <i class="fa"><img src="/images/task-report.png" alt="" style="width: 20px; margin-top: -3px;"></i>
                        <h2>Отчеты</h2>
                    </div>
                    <p>для формирования сводных рейтингов для&nbsp;анализа результатов обучения</p>
                </div>

            </div>

        </div>

    </div>
</section>
<!-- /Services -->
<div class="container main-page__result">
    <div class="result__item container">
        <div class="piechart" data-color="#D9534F" data-trackcolor="rgba(0,0,0,0.04)" data-size="100" data-percent="66" data-width="10" data-animate="1700">
        </div>
        <img class="result__img" src="/images/result-1.png" alt="" style="">
        <div class="result__info">
            <h3 class="result__count"><span class="countTo result__coun" data-speed="1700" style="color: #414141;">{{$u_p}}</span></h3>
            <p class="result__text">пройденные<br> сессии</p>
        </div>
    </div>

    <div class="result__item container">
        <div class="piechart" data-color="#D9534F" data-trackcolor="rgba(0,0,0,0.04)" data-size="100" data-percent="0" data-width="10" data-animate="1700">
        </div>
        <img class="result__img" src="/images/result-2.png" alt="" style="">
        <div class="result__info">
            <h3 class="result__count"><span class="countTo result__coun" data-speed="1700" style="color: #414141;">0</span></h3>
            <p class="result__text">пройденные<br> мероприятия</p>
        </div>
    </div>

    <div class="result__item container">
        <div class="piechart" data-color="#D9534F" data-trackcolor="rgba(0,0,0,0.04)" data-size="100" data-percent="{{$m_p / $p * 100}}" data-width="10" data-animate="1700">
        </div>
        <img class="result__img" src="/images/result-3.png" alt="" style="">
        <div class="result__info">
            <h3 class="result__count"><span class="countTo result__coun" data-speed="1700" style="color: #414141;">{{$m_p}}</span></h3>
            <p class="result__text">организованные<br> сессии</p>
        </div>
    </div>

    
</div>

</section>


@endsection
