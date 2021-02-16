@extends('layouts.layout-1')



@section('header')
	{{$case->name}} 
@endsection


@section('content')
    <div class="btn-group">
        <a href="/adm/cases" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>Основные параметры</h3>
            <div class="form-group">
                <h5>Название кейса</h5>
                <div>{{$case->name}}</div>
            </div>
            <div class="form-group">
                <h5>Для каких категорий работников</h5>
                <div>{{$case->categories}}</div>
            </div>
            
            <div class="form-group">
                <h5>Описание ситуации/Условие</h5>
                <div>{!! $case->conditions !!}</div>
            </div>
            <div class="form-group">
                <h5>Детальное описание</h5>
                <div>{!! $case->description !!}</div>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body">
            <h3>Задания</h3>
            @if ($case->tasks->count() == 0)
            <div class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center"><em>Пока не добавлено ни одного задания</em> </li>
            </div>
            @else
            @foreach ($case->tasks as $task)
                @php $n=1; @endphp
                <div class="form-group">
                    <h5>Задание № {{$n}}</h5>
                    <div>{!! $case->task !!}</div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
                
    <div class="card mt-2">
    <div class="card-body">
	    <h3>Дополнительные файлы:</h3>
	    <p></p>
        <table class="table table-bordered">
            <tbody>
                @if ($case->files()->count() == 0)
                <tr>
                    <td><em>Не добавлено дополнительных файлов в кейс</em></td>
                </tr>
                @endif
                @foreach($case->files as $file)
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

