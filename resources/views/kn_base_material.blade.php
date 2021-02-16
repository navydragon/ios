@extends('layouts.app')

@section('content')

<div class="" style="padding: 0px; min-height: 93vh;">
    <div class="container">
        <div class="test__header margin-top-30">
            <div class="margin-right-10"><a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Назад</a></div>
            <img class="test__img" src="/images/{{$material->category ? $material->category->icon:'default.png'}}" alt="">
            <div class="test__info">
                <h3 class="test__title">{{$material->name}}</h3>
                <p class="test__subtitle">{{$material->category->name ?? ""}}</p>
            </div>
        </div>
        <div class="nav-tabs-top">
            <ul class="nav nav-tabs nav-top-border">
                <li class="active"><a href="#data" data-toggle="tab">Материал</a></li>
                <li><a href="#comments" data-toggle="tab">Комментарии</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="data">
                    <div class="card-body">
                        <div class="form-group">
                            <h4>Описание</h4>
                            @if ($material->description)
                                <div>{!! $material->description !!}</div>
                            @else
                                <div><em>нет</em></div>
                            @endif
                            <hr>
                            @if ($material->tags()->count() != 0)
                            <h4>Тэги</h4>
                            <ul class="kn-material__tags-container">
                                @foreach ($material->tags as $tag)
                                    <li class="kn-material__tag">{{$tag->tag}}</li>
                                @endforeach
                            </ul>
                               
                            @endif
                            <hr>
                            <div style="display: flex; justify-content: space-between; width: 350px;">
                                <div><a class="btn btn-primary" target="_blank" href="/{{$material->file->path}}">Скачать</a></div>
                                <div><a class="btn btn-primary" target="_blank" href="/{{$material->file->path}}">Редактировать</a></div>
                                <div><a class="btn btn-primary" target="_blank" href="/{{$material->file->path}}">Удалить</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="comments">
                    <div class="card-body">
                        <div id="messages_div" style="overflow-y: scroll; width: auto; height: 50vh;">
                            @if ($material->comments()->count() == 0)
                            <div class="clearfix margin-bottom-20">
                                <em>Пока для данного материала никто не написал коментарии.</em>
                            </div>
                            @endif
                            @foreach ($material->comments as $comment)
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
                                            {!! $comment->message !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix margin-bottom-60">
                            <div class="border-bottom-1 border-top-1 padding-10">
                                <strong>ДОБАВИТЬ КОММЕНТАРИЙ</strong>
                            </div>
                            <form method="POST" id="message_form" action="/knowledge_base/materials/{{$material->id}}/add_comment">
                                @csrf 
                                <div class="clearfix margin-top-10 margin-bottom-10">
                                    <textarea name="message" class="summernote"></textarea>
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

@if (\Session::has('success'))
    <script>
        $('a[href="#comments"]').tab('show')
    </script>
@endif
@endsection