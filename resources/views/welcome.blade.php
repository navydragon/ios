@extends('layouts.app_unauth')

@section('content')

<div id="header" class="sticky transparent header-md clearfix">

<!-- TOP NAV -->
<header id="topNav">
    <div class="container">

        <!-- Mobile Menu Button -->
        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Logo -->
        <a class="logo pull-left scrollTo" href="#top">
            <img src="/images/logo_cbt_white.png" alt="" />
            <img src="/images/logo_cbt_black.png" alt="" />
        </a>

        <!-- 
            Top Nav 
            
            AVAILABLE CLASSES:
            submenu-dark = dark sub menu
        -->
        <div class="navbar-collapse pull-right nav-main-collapse collapse">
            <nav class="nav-main">

                <!-- 
                    .nav-onepage
                    Required for onepage navigation links
                    
                    Add .external for an external link!
                -->
                <ul id="topMain" class="nav nav-pills nav-main nav-onepage">
                    <li><!-- WORK -->
                        <a href="#services">
                            Функциональности
                        </a>
                    </li>
                    <li><!-- WORK -->
                        <a href="#skills">
                            Кейсы
                        </a>
                    </li>
                    <li><!-- WORK -->
                        <a href="/login">
                            Войти
                        </a>
                    </li>
                    <li><!-- TEAM -->
                        <a href="/register">
                            Регистрация
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>
</header>
<!-- /Top Nav -->

</div>


<!-- SLIDER -->
<section id="slider" class="fullheight">
    <div class="overlay dark-7"><!-- dark overlay [0 to 9 opacity] --></div>

    <div class="slider-video">
        <video poster="demo_files/images/video/back.JPG" preload="auto" loop autoplay muted>
            <source src="/images/1.webm" type="video/webm" />
            <source src="/images/1.mp4" type="video/mp4" />
        </video>
    </div>

    <div class="container main__container" style="z-index: 100;">
        <h1 class="text-white wow fadeInUp main__title" data-wow-delay="0.4s">
            Информационно - образовательная среда
        </h1>
        <h2 class="weight-300 text-white wow fadeInUp main__subtitle" data-wow-delay="0.8s">для проведения оценочных сессий профессиональных знаний по охране труда для руководителей среднего звена ОАО «РЖД»</h2>
        <div class="main__button-container">
            <a class="wow fadeInUp main__button-enter" data-wow-delay="1s" href="/login">Вход</a>
            <a class="wow fadeInUp main__button-reg" data-wow-delay="1s" href="/register">Регистрация</a>
        </div>
        <div class="container main__arrow-container">
            <a href="#services"><div class="main__arrow"></div></a>
        </div>
    </div>
</section>
<!-- /SLIDER -->




<section id="services" class="function">

    <header class="text-center margin-bottom-60">
        <h2>Функциональности системы</h2>
        <p class="lead function__subtitle">Обучение и оценка персонала в области охраны труда</p>
        <hr />
    </header>

    <div class="function__container land__container">


            <div class="text-center function__item">
                <div class="function__round"><img class="function__img" src="/images/session.png" alt="" /></div>
                <h4>Оценочные сессии</h4>
                <p class="size-15">проводятся для обучения и оценки знаний участников по выбранной тематике в области охраны труда</p>
            </div>


            <div class="text-center function__item">
                <div class="function__round"><img class="function__img" src="/images/game.png" alt="" /></div>
                <h4>Кейсы и деловые игры</h4>
                <p class="size-15">позволяют овладеть практическими навыками и развить способности к нестандартному решению вопросов</p>
            </div>


            <div class="text-center function__item">
                <div class="function__round"><img class="function__img" src="/images/survey.png" alt="" /></div>
                <h4>Анкетирование</h4>
                <p class="size-15">проводится в целях выбора темы оценочной сессии и набора инструментов для её формирования</p>
            </div>


            <div class="text-center function__item function__item_four function__item_margin_left ">
                <div class="function__round"><img class="function__img" src="/images/webinar.png" alt="" /></div>
                <h4>Вебинары</h4>
                <p class="size-15">служат для обучения участников по тематике оценочной сессии с возможностью последующего обсуждения</p>
            </div>


            <div class="text-center function__item function__item_margin_rigth">
                <div class="function__round"><img class="function__img" src="/images/test.png" alt="" /></div>
                <h4>Тестирование</h4>
                <p class="size-15">проводится перед проведением оценочной сессии и по её окончание, для оценки изменения уровня знаний участников</p>
            </div>


    </div>

</section>


<!-- CALLOUT -->
<div class="callout callout-theme-color count">
<div class="container">

    <div class="row countTo-sm text-center">

        <h2 class="count__title">Текущие результаты</h2>

        <div class="col-xs-6 col-sm-3 count__item">
            <img class="count__img" src="/images/count-session.png" alt="">
            <br>
            <span class="countTo count__number" data-speed="3000" style="color:#59BA41">14</span>
            <h6 class="count__text">Оценочные сессии</h6>
        </div>

        <div class="col-xs-6 col-sm-3">
            <img class="count__img" src="/images/count-party.png" alt="">
            <br>
            <span class="countTo count__number" data-speed="3000" style="color:#774F38">447</span>
            <h6 class="count__text">Участники</h6>
        </div>

        <div class="col-xs-6 col-sm-3">
            <img class="count__img" src="/images/count-moder.png" alt="">
            <br>
            <span class="countTo count__number" data-speed="3000" style="color:#C02942">327</span>
            <h6 class="count__text">Модераторы</h6>
        </div>

        <div class="col-xs-6 col-sm-3">
            <img class="count__img" src="/images/count-keys.png" alt="">
            <br>
            <span class="countTo count__number" data-speed="3000" style="color:#C02942">100</span>
            <h6 class="count__text">База кейсов</h6>
        </div>

    </div>

</div>
</div>
<!-- /CALLOUT -->

<!-- VISION/SKILL/SPECIAL -->
<section id="skills" class="alternate">
<div class="keys__container land__container">
        <div class="col-lg-1">
        </div>

        <div class="col-lg-4">

            <div class="heading-title heading-border-bottom">
                <h3>Учебные кейсы и деловые игры</h3>
            </div>
            
            <p class="keys__text">Индивидуальное или&nbsp;групповое учебное задание, использующее описание реальной ситуации, или&nbsp;ситуации приближенной к&nbsp;реальной, предназначенное для&nbsp;изучения участниками, с&nbsp;целью <span class="text-selected-red">поиска возможных вариантов решения</span> и/или&nbsp;выбора лучших вариантов разрешения данной ситуации из&nbsp;возможных.</p>
            
            <a href="#" class="main__button-reg keys__button">Просмотр</a>
            
        </div>
    
        <div class="col-lg-6">

            <div class="heading-title heading-border-bottom">
                <h3>Структура</h3>
            </div>

            <div class="toggle toggle-transparent-body toggle-accordion">

                <div class="toggle active">
                    <label><div class="keys__icon keys__icon-description"></div>Описание ситуации</label>
                    <div class="toggle-content">
                        <p>Включает в себя либо изложение реальной ситуации связанной с нарушением требований безопасности производственных процессов: описание случая травмирования работника; нарушения, выявленного в ходе проверки, или аудита, других ситуаций взятых из открытых источников; либо описание смоделированной ситуации, приближенной к реальной, связанной с описанием нарушения, или воздействия потенциальных источников рисков.</p>
                    </div>
                </div>

                <div class="toggle">
                    <label><div class="keys__icon keys__icon-task"></div>Список заданий</label>
                    <div class="toggle-content">
                        <p>Включает в себя задания, направленные на индивидуальное или совместное с группой рассмотрение предложенной ситуации, ее причин и последствий, обсуждение, а также разработку перечня безопасных действий в предложенной или аналогичной ситуациях.</p>
                    </div>
                </div>

                <div class="toggle">
                    <label><div class="keys__icon keys__icon-materials" src="/images/keys-materials.png"></div>Материалы для разбора ситуации</label>
                    <div class="toggle-content">
                        <p>Включает в себя перечень причин, которые привели к возникновению опасной ситуации; перечень нарушений причастных к данной ситуации лиц; перечень последствий для работника, руководителя среднего звена и компании в целом; список действий, которые позволят в дальнейшем предотвратить возникновение подобных ситуаций, а также перечень или алгоритм безопасных действий в данной или аналогичной ситуации руководителя среднего звена.</p>
                    </div>
                </div>

            </div>

    </div>


</div>
</section>
<!-- /VISION/SKILL/SPECIAL -->

<!-- WORK -->
<section id="work">
<div class="container">

    <header class="text-center margin-bottom-60">
        <h2>Оценочные сессии</h2>
        <p class="lead">Проведение деловой игры руководителей среднего звена ОАО «РЖД» (участники)</p>
        <hr />
    </header>


    <!-- PORTFOLIO -->
    <div id="portfolio" class="portfolio-nogutter">

        <div class="mix-grid">

            <div class="col-md-3 col-sm-3 mix" style="margin-rigth: 5px"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-1.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-1.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Вступительное слово начальника отдела ЦБТ</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2018</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3 mix" style="margin-rigth: 5px"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-2.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-2.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Работа в группах (деловая игра)</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2018</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3 mix" style="margin-rigth: 5px"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-3.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-3.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Защита проекта группы участников</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2018</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-4.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-4.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Отработка практических навыков</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2018</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-5.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-5.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Выпуск модераторов группы 5551</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-6.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-6.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Работа участников в группах</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-7.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-7.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Презентация деловой игры</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-8.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-8.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Обсуждения участников группы</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-9.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-9.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Отработка практических навыков</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-10.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-10.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Выпуск модераторов группы 5553</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-11.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-11.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Проведение деловой игры</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->

            <div class="col-md-3 col-sm-3"><!-- item -->

                <div class="item-box">
                    <figure>
                        <span class="item-hover">
                            <span class="overlay dark-5"></span>
                            <span class="inner">

                                <!-- lightbox -->
                                <a class="ico-rounded lightbox" href="/images/session-12.JPG" data-plugin-options='{"type":"image"}'>
                                    <span class="fa fa-plus size-20"></span>
                                </a>

                            </span>
                        </span>

                        <img class="img-responsive" src="/images/session-12.JPG" width="600" height="399" alt="">
                    </figure>

                    <div class="item-box-desc">
                        <h3>Проведение оценочной сессии</h3>
                        <ul class="list-inline categories nomargin">
                            <li><a>Повышение квалификации</a></li>
                            <li><a>2019</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /item -->
            
        </div>

    </div>
    <!-- /PORTFOLIO -->
</div>
</section>
<!-- /WORK -->

<!-- FOOTER -->
<footer id="footer">

<div class="copyright">
    <div class="container">
        <ul class="pull-right nomargin list-inline mobile-block">
            <li><a>Техническая поддержка СДО ИОС ОТ: </a></li>
            <li><a>+7(495)653-55-16</a></li>
            <li><a>ief07@bk.ru</a></li>
        </ul>
        Все права защищены, ОАО «РЖД» &copy; 2021
    </div>
</div>
</footer>
<!-- /FOOTER -->


@endsection
