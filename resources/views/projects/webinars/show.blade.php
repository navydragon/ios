@extends('layouts.app')

@section('content')

<div class="container" style="padding: 50px 0px;">

    <div class="webinar__header">
        <img class="webinar__img" src="/images/accordeon-video.png" alt="">
        <div class="webinar">
            <h3 class="webinar__title">Вебинар {{$webinar->name}}</h3>
            <p class="webinar__subtitle">{!! $webinar->description !!}</p>
        </div>
    </div>
    <ul class="nav nav-tabs nav-top-border">
		<li class="active"><a href="#event" data-toggle="tab">Вебинар</a></li>
		<li><a href="#comments" data-toggle="tab">Комментарии</a></li>
	</ul>
    <div class="tab-content margin-top-20">
        <div class="tab-pane fade in active" id="event">
            <p class="webinar__date">Дата и время проведения:</p>
            <div class="webinar__date-container">
                <img class="session__img" src="/images/session-data.png" alt="">
                <p class="session__date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.Y H:i')}}</p>
            </div>
            <div>
                @if ($type == 'planned')
                    <a class="webinar__btn" href="/webinars/{{$webinar->id}}/go">Войти на вебинар</a>
                @elseif ($webinar->recording_url != '')
                    <a class="webinar__btn" href="/webinars/{{$webinar->id}}/view">Просмотреть запись</a>
                @else
                    <span>Запись недоступна</span>
                @endif
            </div>
        </div>
        <div class="tab-pane fade in" id="comments">
            <div id="messages_div" style="overflow-y: scroll; width: auto; height: 50vh;">
                @if ($event->comments()->count() == 0)
                <div class="clearfix margin-bottom-20">
                    <em>Пока для данного мероприятия никто не написал коментарии.</em>
                </div>
                @endif
                @foreach ($event->comments as $comment)
                    <div class="clearfix margin-bottom-20">
                        <div class="border-bottom-1 border-top-1 padding-10">
                            <span class="pull-right size-14 margin-top-3 text-muted">{{\Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->format('d.m.y H:i:s')}}</span>
                            <strong>{{$comment->author->name}}</strong>
                        </div>	
                        <div class="block-review-content">
                            <div class="block-review-body">
                                <div class="block-review-avatar text-center">
                                    <div class="push-bit">
                                        <span>
                                            <img class="thumbnail pull-left" src="{{ url('storage/avatars/'.$comment->author->avatar) }}" width="70" alt="">
                                        </span>
                                    </div>
                                    <small class="block">{{$comment->author->email}}</small>
                                </div>
                                {!! $comment->comment !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        <div class="clearfix margin-bottom-60">
            <div class="border-bottom-1 border-top-1 padding-10">
                <strong>ДОБАВИТЬ КОММЕНТАРИЙ</strong>
            </div>
            <form method="POST" id="message_form" action="/events/{{$event->id}}/add_comment">
                @csrf
                <div class="clearfix margin-top-10 margin-bottom-10">
                    <textarea name="comment" class="summernote"></textarea>
                </div>    
                <button type="button" onclick="add_comment()" class="btn btn-primary">
                    <i class="fa fa-check"></i>
                    <span>ОТПРАВИТЬ</span>
                </button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    var objDiv = document.getElementById("messages_div");
    objDiv.scrollTop = objDiv.scrollHeight;
    function add_comment()
    {
        if ( !$('.note-editable').html())
        {
            alert("Введите комментарий!")
        }else{
            $("#message_form").submit();
        }

    }
</script>

@if (\Session::has('add_comment'))
    <script>
        $('a[href="#comments"]').tab('show')
        var objDiv = document.getElementById("messages_div");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
@endif

@endsection
