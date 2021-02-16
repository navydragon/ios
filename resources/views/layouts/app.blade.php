<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <title>Информационно-образовательная среда для проведения оценочных сессий профессиональных знаний по охране труда для руководителей среднего звена ОАО «РЖД»</title>
        <meta name="description" content="" />
        <meta name="Author" content="RUT(MIIT)" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- THEME CSS -->
        <link href="{{asset('assets/css/essentials.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/layout.css')}}" rel="stylesheet" type="text/css" />

        <!-- PAGE LEVEL SCRIPTS -->
        <link href="{{asset('assets/css/header-1.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/color_scheme/green.css')}}" rel="stylesheet" type="text/css" id="color_scheme" />
    </head>

    <!--
        AVAILABLE BODY CLASSES:
        
        smoothscroll            = create a browser smooth scroll
        enable-animation        = enable WOW animations

        bg-grey                 = grey background
        grain-grey              = grey grain background
        grain-blue              = blue grain background
        grain-green             = green grain background
        grain-blue              = blue grain background
        grain-orange            = orange grain background
        grain-yellow            = yellow grain background
        
        boxed                   = boxed layout
        pattern1 ... patern11   = pattern background
        menu-vertical-hide      = hidden, open on click
        
        BACKGROUND IMAGE [together with .boxed class]
        data-background="assets/images/_smarty/boxed_background/1.jpg"
    -->
    <body class="smoothscroll enable-animation ">

        

        @auth
            <!-- wrapper -->
        <div id="wrapper">
            
            
            <div style="height: 109px"></div>
            <div id="header" class="static header-md clearfix">
            <div id="topBar">
                <div class="container">
                    <!-- right -->
                    <ul class="top-links list-inline pull-right">
                        <li class="text-welcome hidden-xs">Здравствуйте, <strong>{{ Auth::user()->name }}</strong></li>
                        <li>
                            <a class="no-text-underline" href="/user_settings"><i class="fa fa-user hidden-xs"></i> ЛИЧНЫЙ КАБИНЕТ</a>
                        </li>
                            
                        <li>
                        <a tabindex="-1" href="{{ url('/logout') }}"
                                                onclick="event.preventDefault(); 
                                                document.getElementById('logout-form').submit();">
                                                <i class="glyphicon glyphicon-off"></i> ВЫХОД
                                            </a>
                                            <form id='logout-form' action="{{ url('/logout')}}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                        </a></li>
                    </ul>

                    <!-- left -->
                    <ul class="top-links list-inline">
                        <li class="hidden-xs"><a href="{{url('/contacts')}}">КОНТАКТЫ</a></li>   
                    </ul>
                </div>
            </div>
                    <!-- clearfix sticky header-sm -->
                <header id="topNav">
                    <div class="container">

                        <!-- Mobile Menu Button -->
                        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Logo -->
                        <a class="logo pull-left scrollTo" href="#top">
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
                                    <li id="main"><!-- Главная -->
                                        <a href="/main">
                                            Главная
                                        </a>
                                    </li>
                                    <li id="projects"><!-- Сессии -->
                                        <a href="/projects">
                                            Оценочные сессии
                                        </a>
                                    </li>
                                    <li id="projects"><!-- Сессии -->
                                        <a href="/local_events">
                                            Мероприятия
                                        </a>
                                    </li>
                                    <li id="knbase"><!-- База знаний -->
                                        <a href="/knowledge_base">
                                            База знаний
                                        </a>
                                    </li>
                                    <li id="forums"><!-- Взаидодействие -->
                                        <a href="/forums">
                                            Взаимодействие
                                        </a>
                                    </li>
                                    @if (Auth::user() && Auth::user()->role_id <= 2)
                                    <li><!-- TEAM -->
                                        <a href="/adm">
                                            Управление
                                        </a>
                                    </li>
                                    @endif
                                </ul>

                            </nav>
                        </div>
                    </div>
                </header>
                <!-- /Top Nav -->
            </div>

            @yield('content')
            <!-- HOME -->
            
            <!-- /HOME -->








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

        </div>
        @endauth
        <!-- /wrapper -->

        @guest
            @yield('content')
        @endguest
        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>


        <!-- PRELOADER -->
        <div id="preloader">
            <div class="inner">
                <span class="loader"></span>
            </div>
        </div><!-- /PRELOADER -->

        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = "/assets/plugins/";</script>
        <script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-2.2.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
      
        <script>
            
        </script>
        @yield('scripts')

    </body>
</html>




