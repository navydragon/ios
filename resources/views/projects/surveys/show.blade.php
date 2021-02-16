@extends('layouts.app')

@section('content')
<div class="" style="padding: 0px; min-height: 93vh;">
    <!-- <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/session-vnutr.png" alt="">
                <h2 class="session__title">{{$survey->name}} </h2>
                <div class="margin-left-20"><a class="btn btn-primary" href="{{ url()->previous() }}">Назад</a> </div>
            </div>
        </div>
    </section> -->  
    <div class="container" style="padding: 30px 0px;">

    <div class="survey__header">
        <div><a href="{{ $back_link }}" class="btn btn-primary btn-sm">Назад</a></div>
        <img class="survey__img" src="/images/accordeon-anketa.png" alt="">
        <div class="survey__info">
	        <h3 class="survey__title">{{$survey->name}}</h3>
            <p class="survey__subtitle">{{ $survey->description}}</p>
        </div> 
    </div>
    <ul class="nav nav-tabs nav-top-border">
		<li class="active"><a href="#event" data-toggle="tab">Прохождение анкеты</a></li>
		<li><a href="#comments" data-toggle="tab">Комментарии</a></li>
        @if ($event->is_local == false)
        <li><a href="#assessment" data-toggle="tab">Оценка</a></li>
        @endif
	</ul>
    <div class="tab-content margin-top-20">
        <div class="tab-pane fade in active" id="event">
            <form method="POST" action="/events/{{$event->id}}/surveys/{{$survey->id}}">
                @csrf
                @foreach ($survey->questions as $question)
                <div class="form-group">
                    <label for="q[{{$question->id}}]"><strong>{{$question->body}}</strong></label>
                    <textarea class="form-control" name="q[{{$question->id}}]" required placeholder="Введите ответ">{{$question->user_answer_in_event(Auth::user()->id,$event->id)}}</textarea>
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary survey__button">Отправить</button>
            </form>
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
        @if ($event->is_local == false)
        <div class="tab-pane fade in" id="assessment">
            <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>Участник</th>
                        @foreach ($event->criterias as $criteria)
                        <th>{{$criteria->name}}</th>
                        @endforeach
                        <th>Общая оценка</th>
                        @foreach ($event->competences as $competence)
                        <th>{{$competence->name}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach ($project->members as $member)
                    <tr>
                        <td>{{$member->name}}</td>
                        @foreach ($event->criterias as $criteria)
                            <td><a href="#" data-pk="{{$member->id}}" data-name="{{$criteria->id}}" data-value="{{$member->get_event_criteria_by_expert($event->id,Auth::user()->id,$criteria->id)}}" class="event_criteria_mark"></a></td>
                        @endforeach
                        <td><a href="#" data-pk="{{$member->id}}" data-value="{{$member->get_event_mark_by_expert($event->id,Auth::user()->id)}}" class="event_mark"></a></td>
                        @if($project->competence_assessment)
                            @foreach ($event->competences as $competence)
                            <td><a href="#" data-pk="{{$member->id}}" data-name="{{$competence->id}}" data-value="{{$member->get_event_competence_mark_by_expert($event->id,Auth::user()->id,$competence->id)}}" class="event_competence_mark"></a></td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
</div>

@endsection


@section('scripts')
<link rel="stylesheet" href="/vendor/libs/bootstrap-editable/bootstrap-editable.css">
<script src="/vendor/libs/bootstrap-editable/bootstrap-editable.min.js"></script>
<script type="text/javascript">
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.params = function (params) {
    params._token = $("#_token").data("token");
    return params;
	};
	</script>

	<script type="text/javascript">
	$('.event_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/assess',
	})
	$('.event_competence_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/competence_assess',
	})
	$('.event_criteria_mark').editable ({
		emptytext: 'Нет оценки',
		title: 'Введите оценку',
       	url: '/adm/projects/events/{{$event->id}}/criteria_assess',
	})
	</script>
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
