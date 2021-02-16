@extends('layouts.app')

@section('content')

<div class="container">
	<h3>{{$thread->name}}</h3>
	<h4>Сообщения:</h4>
		@foreach ($thread->messages as $message)
			<div class="clearfix margin-bottom-60">
				<div class="border-bottom-1 border-top-1 padding-10">
                
					<span class="pull-right size-11 margin-top-3 text-muted">{{\Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->format('d.m.Y H:i:s')}}</span>
					<strong>{{$message->author->name}}</strong></a>
				</div>	
				<div class="block-review-content">

					<div class="block-review-body">

						<div class="block-review-avatar text-center">
							<div class="push-bit">
								<span>
									<img src="{{ url('storage/avatars/'.$message->author->avatar) }}" width="100" alt="avatar">
                                </span>
							</div>
							<small class="block">{{$message->author->email}}</small>
							<small class="block">{{$message->author->forum_messages->count()}} сообщений</small>
						</div>

						{!! $message->message !!}
					</div>
				</div>
			</div>
            <hr>
		@endforeach
		<div class="clearfix margin-bottom-60">

			<div class="border-bottom-1 border-top-1 padding-10">
				<strong>ДОБАВИТЬ СООБЩЕНИЕ</strong></a>
			</div>
			
			<form method="POST" action="/forums/{{$forum->id}}/threads/{{$thread->id}}">
				@csrf
				<div class="clearfix margin-top-30 margin-bottom-20">
					<textarea name="message_text" class="summernote form-control" data-height="200" ></textarea>
				</div>
				
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-check"></i>
					<span>ОТПРАВИТЬ</span>
				</button>


			</form>

		</div>

</div>

@endsection