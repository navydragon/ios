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
            <li class="list-group-item"><a href="/user_projects"><i class="fa fa-users"></i> ОЦЕНОЧНЫЕ СЕССИИ</a></li>
            <li class="list-group-item active"><a href="/user_local"><i class="fa fa-calendar"></i> ЛОКАЛЬНЫЕ МЕРОПРИЯТИЯ</a></li>
            <li class="list-group-item"><a href="/user_dialogs"><i class="fa fa-comment"></i> СООБЩЕНИЯ</a></li>
            
		</ul>
	</div>

	<div class="col-md-9">
		<h3>Мои локальные мероприятия</h3>
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
            @foreach ($events as $event)
            @php $e_d = $event->description(); @endphp
            <li class="kn-material__item">
                <img class="kn-material__item-img" src="{{$e_d->icon}}" alt="">
                <div class="kn-material__info">
                    <span class="kn-material__item-category">Доступно до: {{\Carbon\Carbon::createFromTimeStamp(strtotime($event->event_parameter->max_date))->format('d.m.y')}} </span>
                    <h3 class="kn-material__item-name">{{$e_d->name}}</h3>
                    <ul class="kn-material__tags-container">
                        <li class="kn-material__tag">{{$e_d->type}}</li>
                        @if (isset($event->event_results->first()->is_passed))
                        <span class="accordeon__item-type"></span>
                        @endif
                    </ul>
                </div>
                
                <div class="local__container">
                    @if  ($event->event_parameter->max_date >= \Carbon\Carbon::now())
                        <a href="/events/{{$event->id}}" target="_blank" class="local__button">Пройти</a>
                    @endif
                    @if ($event->event_results->count() != 0)
                        <a href="#" class="local__button" data-toggle="modal" data-remote="/events/{{$event->id}}/results/{{Auth::user()->id}}"  data-target="#myModal" class="btn btn-primary">Результаты</a>
                    @endif
                </div>
            </li>
              
            
            @endforeach
        </ul>

	</div>
</div>

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Просмотр результатов мероприятия</h4>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
</script>
@if (\Session::has('error_add_dialog'))
    <script>
        $('a[href="#new_dialog"]').tab('show')
    </script>
@endif
@endsection