@extends('layouts.app')

@section('content')


<div class="container" style="margin-top: 50px;">
	<div class="col-md-3">
		<div class="thumbnail text-center">
			<img class="img-fluid" id="photo_main" src="{{ url('storage/avatars/'.Auth::user()->avatar) }}"  alt="" />
			<h2 class="size-18 margin-top-10 margin-bottom-10">{{ Auth::user()->name }}</h2>
            <h3 class="size-12 margin-top-0 margin-bottom-10 text-muted">{{ Auth::user()->role->name }}</h3>
            <h3 class="size-12 margin-top-0 margin-bottom-10 text-muted">{{ Auth::user()->filial->name }}</h3>
		</div>

		<ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
			<!--<li class="list-group-item "><a href="#"><i class="fa fa-eye"></i> ПРОФИЛЬ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-tasks"></i> ОБУЧЕНИЕ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-comments-o"></i> СООБЩЕНИЯ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-history"></i>ЗАГРУЗКИ</a></li> -->
            <li class="list-group-item"><a href="/user_settings"><i class="fa fa-gears"></i> НАСТРОЙКИ</a></li>
            <li class="list-group-item active"><a href="/user_projects"><i class="fa fa-users"></i> ОЦЕНОЧНЫЕ СЕССИИ</a></li>
            <li class="list-group-item"><a href="/user_local"><i class="fa fa-calendar"></i> ЛОКАЛЬНЫЕ МЕРОПРИЯТИЯ</a></li>
            <li class="list-group-item"><a href="/user_dialogs"><i class="fa fa-comment"></i> СООБЩЕНИЯ</a></li>
            
		</ul>
	</div>

	<div class="col-md-9">
		<h3>Мои оценочные сессии</h3>
		@if(session()->has('success'))
    		<div class="alert alert-success">
        		{{ session()->get('success') }}
    		</div>
		@endif
		@if(session()->has('error'))
    		<div class="alert alert-danger">
        		{{ session()->get('error') }}
    		</div>
		@endif

        <ul class="kn-material__container">
            @foreach ($projects as $project)
            <li class="kn-material__item">
                <img class="kn-material__item-img" src="/images/kn-base-session.png" alt="">
                <div class="kn-material__info">
                    <span class="kn-material__item-category">{{\Carbon\Carbon::createFromTimeStamp(strtotime($project->start_date))->format('d.m.y')}} - {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->end_date))->format('d.m.Y')}}</span>
                    <h3 class="kn-material__item-name">{{$project->name}}</h3>
                    <ul class="kn-material__tags-container">
                        <li class="kn-material__tag">{{$project->p_status->name}}</li>
                    </ul>
                </div>
                @if ($project->status == 2)
                <a href="/projects/{{$project->id}}" target="_blank" class="kn-material__button">Войти</a>
                @elseif ($project->status == 4)
                <a href="/projects/{{$project->id}}/show_results" target="_blank" class="kn-material__button">Результаты</a>
                @endif
            </li>
            @endforeach
        </ul>

	</div>
</div>
@endsection

@section('scripts')

@if (\Session::has('error_add_dialog'))
    <script>
        $('a[href="#new_dialog"]').tab('show')
    </script>
@endif
@endsection