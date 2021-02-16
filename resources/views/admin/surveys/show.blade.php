@extends('layouts.layout-1')


@section('header')
	{{$survey->name}}
@endsection

@section('content')
    <div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/surveys" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#questions">Вопросы анкеты</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Название</label>
                    <p>{{$survey->name}}</p>                        
                </div>
                <div class="form-group">
                    <label for="">Описание</label>
                    @if (!empty($survey->description))
                        <table class="table table-bordered"><tr><td>{{$survey->description}}</td></tr></table>
                    @else
                        <p><em>нет</em></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="questions">
            <div class="card-body">
                <h5>Вопросы анкеты ({{$questions->count()}})</h5>
                <table class="table table-bordered">
                    @foreach ($questions as $question)
                        <tr><td>{{$question->body}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

	
	
@endsection