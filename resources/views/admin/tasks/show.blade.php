@extends('layouts.layout-1')


@section('header')
	{{$task->name}}
@endsection

@section('content')
	<div class="btn-group">
	    <a href="/adm/tasks" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
    </div>
    <hr>
	<div class="card">
        <div class="card-body">
                <h3>Основные параметры</h3>
                <div class="form-group">
                    <h5>Название задания</h5>
                    <div>{{$task->name}}</div>
                </div>
                
                <div class="form-group">
                    <h5>Описание</h5>
                    <div>{!! $task->description !!}</div>
                </div>
                <div class="form-group">
                    <h5>Текст задания</h5>
                    <div>{!! $task->text !!}</div>
                </div>
        </div>
    </div>
    <div class="card mt-4">
    <div class="card-body">
	    <h3>Дополнительные файлы:</h3>
	    <p></p>
        <table class="table table-bordered">
            <tbody>
                @if ($task->files()->count() == 0)
                <tr>
                    <td><em>Не добавлено дополнительных файлов в задание</em></td>
                </tr>
                @endif
                @foreach($task->files as $file)
                @php $source = $file->source; @endphp
                <tr>
                    <td><a href="/{{$source->path}}" target="_blank">{{$source->title}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection