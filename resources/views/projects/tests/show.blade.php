@extends('layouts.app')

@section('content')

<div class="container" style="padding: 50px 0px; min-height: 82vh;">

    <div class="test__header">
        <div><a href="{{ $back_link }}" class="btn btn-primary btn-sm">Назад</a></div>
        <img class="test__img" src="/images/accordeon-test.png" alt="">
        <div class="test__info">
            <h3 class="test__title">{{$test->name}}</h3>
            <p class="test__subtitle">Просмотрите предыдущие попытки или начните тест заново</p>
        </div>
    </div>
    <ul class="nav nav-tabs nav-top-border">
		<li class="active"><a href="#event" data-toggle="tab">Задание</a></li>
		<li><a href="#comments" data-toggle="tab">Комментарии</a></li>
	</ul>
    <div class="tab-content margin-top-20">
        <div class="tab-pane fade in active" id="event">
            <ul class="kn-category__container">
                <li class="kn-category__item">
                    <div class="kn-category__item-link">
                        <img class="kn-category__item-img" src="/images/test-question.png" alt="">
                        <p class="kn-category__item-name">Количество вопросов</p>
                        <span class="kn-category__item-count countTo" data-speed="1700">{{$event->event_parameter["show_questions"]}}</span>
                    </div>
                </li>
                <li class="kn-category__item">
                    <div class="kn-category__item-link">
                        <img class="kn-category__item-img" src="/images/test-ball.png" alt="">
                        <p class="kn-category__item-name">Проходной балл</p>
                        <span class="kn-category__item-count countTo" data-speed="1700">{{$event->event_parameter["passing_score"]}}</span>
                    </div>
                </li>
                <li class="kn-category__item">
                    <div class="kn-category__item-link">
                        <img class="kn-category__item-img" src="/images/test-time.png" alt="">
                        <p class="kn-category__item-name">Время на попытку (мин.)</p>
                        <span class="kn-category__item-count countTo" data-speed="1700">{{$event->event_parameter["attempt_time"]}}</span>
                    </div>
                </li>
            </ul>
            @php $attempts = $test->user_attempts(Auth::user()->id,$event->id)->get(); @endphp
            <p class="test__attemps">Попыток использовано {{$attempts->count()}} из {{$event->event_parameter["max_attempts"]}}</p>
            <hr>
            @if ($attempts->count() > 0 )
                
                <h4 class="test__title">Результаты Ваших предыдущих попыток</h4>
                <table class="table table-bordered table-stripped" style="margin-top: 15px;">
                    <thead>
                        <tr class="table__header">
                            <td class="table__header-item">ID попытки</td>
                            <td class="table__header-item">Состояние</td>
                            <td class="table__header-item">Дата</td>
                            <td class="table__header-item">Просмотр</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attempts as $attempt)
                            <tr>
                                <td class="table__main">{{$attempt->id}}</td>
                                <td class="table__main">{{$attempt->text_status()}}</td>
                                <td class="table__main">{{\Carbon\Carbon::createFromTimeStamp(strtotime($attempt->updated_at))->format('d.m.y')}}</td>
                                <td class="table__main">
                                    @if ($attempt->status != 0)
                                        <a href="/tests/attempts/{{$attempt->id}}/review">Просмотр</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach		
                    </tbody>
                </table>
                
            @endif

            <div style="display: flex;">
                <a style="margin-right: 10px; background-color: #333; border: 2px solid #333;" href="{{ $back_link }}" class="btn btn-primary">Назад</a>
                
                @if ($test->user_attempts(Auth::user()->id,$event->id)->get()->count() > 0 )
                    @if ($attempt->status == 0)
                    <a href="/tests/attempts/{{$attempt->id}}" class="btn btn-primary">Продолжить попытку</a>
                    @else
                    <a href="/events/{{$event->id}}/tests/{{$test->id}}/new_attempt" class="btn btn-primary">Пройти тест заново</a>
                    @endif
                @else
                    <a href="/events/{{$event->id}}/tests/{{$test->id}}/new_attempt" class="btn btn-primary">Пройти тест</a>
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