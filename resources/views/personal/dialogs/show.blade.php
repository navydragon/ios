@extends('layouts.app')

@section('content')


<div class="container">
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
        <div class="row"><div class="col-md-12">
        @if ($dialog->user1 == Auth::user()->id)
            <h3>Диалог с {{$dialog->author_2->name}}</h3>  
        @else
            <h3>Диалог с {{$dialog->author_1->name}}</h3>  
        @endif
		
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
        <div class="box-inner">
		<h3>
			<span class="pull-right size-11 text-warning" href="#">сообщений: <span>{{$dialog->messages()->count()}}</span> </span>
			СООБЩЕНИЯ
		</h3>
		<div id="messages_div" style="overflow-y: scroll; width: auto; height: 350px;">
            @foreach ($dialog->messages as $message)
			<div class="clearfix margin-bottom-10 d-flex"><!-- post item -->
                <div class="align-self-start">
				    <img class="thumbnail pull-left" src="{{ url('storage/avatars/'.$message->author->avatar) }}" width="70" alt="">
                </div>
				<h4 class="size-14 margin-bottom-10 noborder nopadding">{{$message->author->name}}</h4>
				<p class="size-14 nomargin noborder nopadding">{!! $message->message !!}</p>
    			<span class="size-11 text-muted mr-20">{{\Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->format('d.m.y H:i:s')}}</span>			
			</div><hr>
            @endforeach
			</div>
		<hr>
	<div class="box-footer">
		<form method="POST" id="message_form" action="/user_dialogs/{{$dialog->id}}/add_message">
        @csrf
		<div class="inline-search clearfix">
			<h4>Текст сообщения</h4>
			<div class="clearfix margin-top-20 margin-bottom-20">
                <textarea id="message" name="message" class="summernote form-control" data-height="200" ></textarea>
            </div>						
		</div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="add_message()" type="button">ОТПРАВИТЬ СООБЩЕНИЕ</button>
        </div>
		</form>

	</div>

</div>
		</div></div>
	</div>
</div>
@endsection

@section('scripts')
<script>
    var objDiv = document.getElementById("messages_div");
    objDiv.scrollTop = objDiv.scrollHeight;
    function add_message()
    {
        if ( !$('.note-editable').html())
        {
            alert("Введите сообщение!")
        }else{
            $("#message_form").submit();
        }

    }
</script>

@endsection
