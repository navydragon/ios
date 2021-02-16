<?php $routeName = Route::currentRouteName(); ?>

<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">

    <!-- Inner -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <li class="sidenav-item{{ Request::is('/adm') ? ' active' : '' }}">
            <a href="/adm" class="sidenav-link"><i class="sidenav-icon fas fa-home"></i><div>Главная</div></a>
        </li>

        <li class="sidenav-item{{ strpos($routeName, 'dashboards.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-th-list"></i><div>Типы мероприятий</div></a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="/adm/surveys" class="sidenav-link"><div>Анкеты</div></a>
                </li>
                <li class="sidenav-item">
                    <a href="/adm/tests" class="sidenav-link"><div>Тестирования</div></a>
                </li>  
                <li class="sidenav-item">
                    <a href="/adm/learning_modules" class="sidenav-link"><div>Учебные материалы</div></a>
                </li>  
                <li class="sidenav-item">
                    <a href="/adm/tasks" class="sidenav-link"><div>Задания</div></a>
                </li>
                <li class="sidenav-item">
                    <a href="/adm/webinars" class="sidenav-link"><div>Вебинары</div></a>
                </li>
                <li class="sidenav-item">
                    <a href="/adm/cases" class="sidenav-link"><div>Кейсы</div></a>
                </li>  
            </ul>
        </li>
        <li class="sidenav-item {{ Request::is('/adm/projects') ? ' active' : '' }}">
            <a href="/adm/projects" class="sidenav-link"><i class="sidenav-icon fas fa-edit"></i><div>Оценочные сессии</div></a>
        </li>
        <li class="sidenav-item {{ Request::is('/adm/local_events') ? ' active' : '' }}">
            <a href="/adm/local_events" class="sidenav-link"><i class="sidenav-icon fas fa-edit"></i><div>Локальные мероприятия</div></a>
        </li>
        <li class="sidenav-item {{ Request::is('/adm/kn_base') ? ' active' : '' }}">
            <a href="/adm/kn_base" class="sidenav-link"><i class="sidenav-icon fas fa-file-alt"></i><div>База знаний</div></a>
        </li>
        <li class="sidenav-item{{ Request::is('/adm/tickets') ? ' active' : '' }}">
            <a href="/adm/tickets" class="sidenav-link"><i class="sidenav-icon fas fa-ticket-alt"></i><div>Заявки</div></a>
        </li>
        <li class="sidenav-item{{ strpos($routeName, 'dashboards.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-address-book"></i><div>Орг. структура</div></a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="/adm/users" class="sidenav-link"><div>Пользователи</div></a>
                </li>
                <li class="sidenav-item">
                    <a href="/adm/filials" class="sidenav-link"></i><div>Филиалы</div></a>
                </li>   
            </ul>
        </li>
        <li class="sidenav-item{{ Request::is('/adm/reports') ? ' active' : '' }}">
            <a href="/adm/reports" class="sidenav-link"><i class="sidenav-icon fas fa-chart-bar"></i><div>Отчетность и аналитика</div></a>
        </li>
    </ul>
</div>
