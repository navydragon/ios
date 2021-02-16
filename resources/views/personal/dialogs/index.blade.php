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
            <li class="list-group-item"><a href="/user_local"><i class="fa fa-calendar"></i> ЛОКАЛЬНЫЕ МЕРОПРИЯТИЯ</a></li>
            <li class="list-group-item active"><a href="/user_dialogs"><i class="fa fa-comment"></i> СООБЩЕНИЯ</a></li>
            
		</ul>
	</div>

	<div class="col-md-9">
		<h3>Мои диалоги</h3>
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
		<ul class="nav nav-tabs nav-top-border">
			<li class="active"><a href="#dialogs" data-toggle="tab">Список диалогов</a></li>
			<li><a href="#new_dialog" data-toggle="tab">Новый диалог</a></li>
		</ul>

		<div class="tab-content margin-top-20">

			<!-- DIALOGS TAB -->
			<div class="tab-pane fade in active" id="dialogs">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <span class="label label-sea pull-right">Диалогов: {{$dialogs->count()}}</span>
                        <h2 class="panel-title">Мои диалоги</h2>
                    </div>
                    <div class="panel-body nopadding">	
                        <table class="table">
                            <tbody>
                                @foreach ($dialogs as $dialog)	
                                <tr>
                                    <td>
                                    @if ($dialog->user1 == Auth::user()->id)
                                    <img class="thumbnail pull-left" src="{{ url('storage/avatars/'.$dialog->author_2->avatar) }}" width="100" alt="">
                                    @else
                                    <img class="thumbnail pull-left" src="{{ url('storage/avatars/'.$dialog->author_1->avatar) }}" width="100" alt="">
                                    @endif
                                    </td>
                                    <td>
                                    <h4 class="size-15 nomargin noborder nopadding bold">
                                        @if ($dialog->user1 == Auth::user()->id)
                                            {{$dialog->author_2->name}}
                                        @else
                                            {{$dialog->author_1->name}}
                                        @endif
                                    </h4>
                                    <span class="size-13 text-muted">
                                        @if ($dialog->last_message->author_id == Auth::user()->id)
                                        <span><strong>Вы:</strong></span>
                                        @else
                                        <span><strong>{{$dialog->last_message->author->name}}</strong></span>
                                        @endif
                                        <em>{{$dialog->last_message->message}} </em>
                                        <span class="text-success size-11">{{\Carbon\Carbon::createFromTimeStamp(strtotime($dialog->last_message->created_at))->format('d.m.y H:i:s')}}</span>
                                    </span>
                                    </td>
                                    <td><a href="/user_dialogs/{{$dialog->id}}" class="btn btn-primary pull-right">Перейти к диалогу</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
			<!-- DIALOGS TAB -->

			<!-- NEW DIALOG TAB -->
			<div class="tab-pane fade" id="new_dialog">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <h2 class="panel-title bold">Начать новый диалог</h2>
                    </div>

                    <div class="panel-body">
                    <form id="new_dialog_form" class="clearfix" method="post" action="/add_dialog">
                    @csrf
                    <div class="fancy-form fancy-form-select"><!-- select2 -->
                            <select name="user_id" class="form-control select2" style="width:100%">
                                <option value="">--- Выберите, с кем начать диалог ---</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} ({{$user->filial ? $user->filial->name : ""}})</option>
                                @endforeach
                            </select>
                            <i class="fancy-arrow-double"></i>
                    </div>
                    @if (\Session::has('error_add_dialog'))
                        <div class="alert alert-danger margin-bottom-30"><!-- DANGER -->
                            <strong>Ошибка!</strong> {!! \Session::get('error_add_dialog') !!}
                        </div>
                    @endif
                    <div class="form-group margin-top-20">
                        <label>Ваше сообщение</label>
                        <div class="clearfix margin-top-20 margin-bottom-20">
                            <textarea name="message" class="summernote form-control" data-height="200" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Отправить сообщение </button>
                    </div>
                    </form>
                    </div>
                </div>
			</div>
			<!-- /NEW DIALOG -->

		</div>
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