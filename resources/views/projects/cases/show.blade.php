@extends('layouts.app')

@section('content')

<div class="container"  style="padding: 50px 0px; min-height: 82vh;">
    <div class="test__header">
        <div class="margin-right-10"><a href="{{ $back_link }}" class="btn btn-primary btn-sm">Назад</a></div>
        <img class="test__img" src="/images/accordeon-keys.png" alt="">
        <div class="test__info">
            <h3 class="test__title">Кейс «{{$case->name}}»</h3>
        </div>
    </div>
    <ul class="nav nav-tabs nav-top-border">
        <li class="active"><a href="#event" data-toggle="tab">Описание кейса</a></li>
        <li><a href="#solution" data-toggle="tab">Решение кейса</a></li>
		<li><a href="#comments" data-toggle="tab">Комментарии</a></li>
	</ul>
    <div class="tab-content margin-top-20">
        <div class="tab-pane fade in active" id="event">
            <div class="toggle toggle-transparent-body">
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-condition"></div>
                        <span class="accordeon__stage">Описание ситуации/Условие</span>
                    </label>
                    <div class="toggle-content">
                        {!! $case->conditions !!}
                    </div>
                </div>
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-details"></div>
                        <span class="accordeon__stage">Детальное описание</span>
                    </label>
                    <div class="toggle-content">
                        {!! $case->description !!}
                    </div>
                </div>
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-task"></div>
                        <span class="accordeon__stage">Задания</span>
                    </label>
                    <div class="toggle-content">
                        @foreach ($case->tasks as $task)
                        <h5 class="mb-0">Задание №{{$task->sort}}</h5>
                        <div class="mb-4">{!! $task->task !!}</div>
                        @endforeach
                    </div>
                </div>
               
            </div>
            @if ($case->files)
                <h4 class="task__title">Вложенные файлы:</h4>
                @foreach ($case->files as $case_file)
                <li><a target="_blank" href="/{{$case_file->source->path}}">{{$case_file->source->title}}</a></li>
                @endforeach
            @endif

            <!--<h4 class="task__title">Загрузить выполненный кейс:</h4>
            <form method="POST" class="form-horizontal" action="/events/{{$event->id}}/cases/{{$case->id}}/store_user_file" enctype="multipart/form-data">
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
            </table>-->
        </div>

        <div class="tab-pane fade in" id="solution">

            <!-- tabs -->
            <div class="col-md-3 col-sm-3">
                <ul class="nav nav-tabs nav-stacked nav-alternate">
                    @foreach($case->tasks as $task)
                    @php $uct = $task->user_answer(Auth::user()->id,$event->id); @endphp
                    <li class="{{$task->sort == 1? 'active':''}}">
                        <a href="#tab_{{$task->sort}}" data-toggle="tab" style="display: flex">
                            Задание {{$task->sort}}
                            @if (count($uct) > 0)
                            <div style="margin: 0px 0px 0px auto" class="accordeon__item-type"></div>
                            @endif
                        </a>   
                    </li>
                    @endforeach
                    <li>
                        <a href="#tab_errors" data-toggle="tab" style="display: flex">
                            Возможные ошибки
                            @if (count($case_results) >0 && $case_results->first()->possible_errors)
                            <div style="margin: 0px 0px 0px auto" class="accordeon__item-type"></div>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#tab_effects" data-toggle="tab" style="display: flex">
                            Последствия ошибок
                            @if (count($case_results) >0 && $case_results->first()->error_effects)
                            <div style="margin: 0px 0px 0px auto" class="accordeon__item-type"></div>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#tab_algorythms" data-toggle="tab" style="display: flex">
                            Алгоритмы
                            @if (count($case_results) >0 && $case_results->first()->algorithms)
                            <div style="margin: 0px 0px 0px auto" class="accordeon__item-type"></div>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#tab_conclusions" data-toggle="tab" style="display: flex">
                            Выводы
                            @if (count($case_results) >0 && $case_results->first()->conclusions)
                            <div style="margin: 0px 0px 0px auto" class="accordeon__item-type"></div>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <!-- tabs content -->
            <div class="col-md-9 col-sm-9">
                <div class="tab-content tab-stacked nav-alternate">
                    @foreach($case->tasks as $task)
                    <div id="tab_{{$task->sort}}" class="tab-pane {{$task->sort == 1? 'active':''}}">
                        <h4>Задание №{{$task->sort}}</h4>
                        {!! $task->task !!}
                        <h4>Ваш ответ:</h4>
                        <form method="POST" id="form_task_{{$task->id}}" action="/events/{{$event->id}}/cases/{{$case->id}}/tasks/{{$task->id}}">
                            @csrf
                            @php $uct = $task->user_answer(Auth::user()->id,$event->id); @endphp
                            <textarea name="answer" id="task_{{$task->id}}" class="summernote form-control" cols="30" rows="10">{!! count($uct)==0 ? "" : $uct->first()->pivot->answer !!}</textarea>
                            <button type="button" onclick="onSubmit('task_{{$task->id}}')" class="btn btn-primary">ОТПРАВИТЬ ОТВЕТ</button>
                        </form>
                        
                    </div>
                    @endforeach
                

                    <div id="tab_errors" class="tab-pane">
                        <h4>Возможные ошибки</h4>
                        <p></p>
                        <h4>Ваш ответ:</h4>
                        <form method="POST" id="form_pe_{{$case->id}}" action="/events/{{$event->id}}/cases/{{$case->id}}/store_answer/pe">
                            @csrf
                            <textarea name="answer" id="pe_{{$case->id}}" class="summernote form-control" cols="30" rows="10">
                                {!! count($case_results) > 0 ? $case_results->first()->possible_errors : "" !!}
                            </textarea>
                            <button type="button" onclick="onSubmit('pe_{{$case->id}}')" class="btn btn-primary">ОТПРАВИТЬ ОТВЕТ</button>
                        </form>
                    </div>

                    <div id="tab_effects" class="tab-pane">
                        <h4>Последствия ошибок</h4>
                        <p></p>
                        <h4>Ваш ответ:</h4>
                        <form method="POST" id="form_ee_{{$case->id}}" action="/events/{{$event->id}}/cases/{{$case->id}}/store_answer/ee">
                            @csrf
                            <textarea name="answer" id="ee_{{$case->id}}" class="summernote form-control" cols="30" rows="10">
                                {!! count($case_results) > 0 ? $case_results->first()->error_effects : "" !!}
                            </textarea>
                            <button type="button" onclick="onSubmit('ee_{{$case->id}}')" class="btn btn-primary">ОТПРАВИТЬ ОТВЕТ</button>
                        </form>
                    </div>

                    <div id="tab_algorythms" class="tab-pane">
                        <h4>Алгоритмы</h4>
                        <p></p>
                        <h4>Ваш ответ:</h4>
                        <form method="POST" id="form_al_{{$case->id}}" action="/events/{{$event->id}}/cases/{{$case->id}}/store_answer/al">
                            @csrf
                            <textarea name="answer" id="al_{{$case->id}}" class="summernote form-control" cols="30" rows="10">
                                {!! count($case_results) > 0 ? $case_results->first()->algorithms : "" !!}
                            </textarea>
                            <button type="button" onclick="onSubmit('al_{{$case->id}}')" class="btn btn-primary">ОТПРАВИТЬ ОТВЕТ</button>
                        </form>
                    </div>

                    <div id="tab_conclusions" class="tab-pane">
                        <h4>Выводы</h4>
                        <p></p>
                        <h4>Ваш ответ:</h4>
                        <form method="POST" id="form_cs_{{$case->id}}" action="/events/{{$event->id}}/cases/{{$case->id}}/store_answer/cs">
                            @csrf
                            <textarea name="answer" id="cs_{{$case->id}}" class="summernote form-control" cols="30" rows="10">
                                {!! count($case_results) > 0 ? $case_results->first()->conclusions : '' !!}
                            </textarea>
                            <button type="button" onclick="onSubmit('cs_{{$case->id}}')" class="btn btn-primary">ОТПРАВИТЬ ОТВЕТ</button>
                        </form>
                    </div>
                </div>
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

    function onSubmit(id)
    {
        
        let a = $('#'+id).code();
        if (a.replace(/ +/g, ' ').trim() === '')
        {
            alert("Введите текст ответа!")
        }else{
            $("#form_"+id).submit();
        }

        //alert($('#'+id).summernote('code'));
    }
</script>

@if (\Session::has('add_comment'))
    <script>
        $('a[href="#comments"]').tab('show')
        var objDiv = document.getElementById("messages_div");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
@endif

@if (\Session::has('task_store_success'))
    <script>
        $('a[href="#solution"]').tab('show')
        //$('a[href="#solution"]').tab('show')
        //toastr.success('{!! \Session::get('task_store_success[0]') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection
