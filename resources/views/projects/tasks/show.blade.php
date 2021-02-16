@extends('layouts.app')

@section('content')

<div class="container"  style="padding: 50px 0px; min-height: 82vh;">
    <div class="test__header">
        <div class="margin-right-10"><a href="{{ $back_link }}" class="btn btn-primary btn-sm">Назад</a></div>
        <img class="test__img" src="/images/accordeon-task.png" alt="">
        <div class="test__info">
            <h3 class="test__title">{{$task->name}}</h3>
            <p class="test__subtitle">{{$task->description}}</p>
        </div>
    </div>
    <ul class="nav nav-tabs nav-top-border">
		<li class="active"><a href="#event" data-toggle="tab">Задание</a></li>
		<li><a href="#comments" data-toggle="tab">Комментарии</a></li>
	</ul>

    <div class="tab-content margin-top-20">
        <div class="tab-pane fade in active" id="event">
            <p>{!! $task->text !!}</p>
            @if ($task->files()->count() != 0)
                <h4 class="task__title">Вложенные файлы:</h4>
                @foreach ($task->files as $task_file)
                <li><a target="_blank" href="/{{$task_file->source->path}}">{{$task_file->source->title}}</a></li>
                @endforeach
            @endif

            <hr>	
            <h4 class="task__title">Загрузить выполненное задание:</h4>
        <form method="POST" class="form-horizontal" action="/events/{{$event->id}}/tasks/{{$task->id}}/store_user_file" enctype="multipart/form-data">
            @csrf
            <fieldset>
            
                <div class="form-download__container">
                    <img class="form-download__img" src="/images/download-task.png" alt="">
                    <div class="form-download__input">
                        <input class="btn btn-default" name="upl" id="upl" type="file">
                        <p class="form-download__caption">
                            Выберите файл и нажмите кнопку «Загрузить»
                        </p>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                    </div>
                </div>
                
            </fieldset>
            </form>
            <h4 class="task__title">Загруженные Вами файлы:</h4>
            <table class="table table-bordered">
                <thead>
                    <th>Файл</th>
                    <th>Дата загрузки</th>
                </thead>
                <tbody>
                    @foreach (Auth::user()->event_files($event->id)->get() as $event_file)
                        <tr>
                            <td><a href="/{{$event_file->file->path}}">{{$event_file->file->title}}</a></td>
                            <td>{{$event_file->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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