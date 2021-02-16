@extends('layouts.layout-1')


@section('header')
	{{$test->name}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();

</script>
@endsection

@section('content')
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/tests" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#questions">Вопросы теста</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <h5>Название</h5>
                <p>{{$test->name}}</p>
                <h5>Описание</h5>
                @if (!empty($test->description))
                    <table class="table table-bordered"><tr><td>{{$test->description}}</td></tr></table>
                @else
                    <p><em>нет</em></p>
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="questions">
            <div class="card-body">
                <table class="table table-bordered datatables-demo">
                    <thead style="background-color: #333333; color: #fff;">
                        <tr>
                            <th class="w-50" >Текст вопроса</th>
                            <th class="w-20">Тип вопроса</th>
                            <th class="w-30">Варианты ответов</th>
                        </tr>
                    </thead>
                    @foreach ($test->questions as $question)
                        <tr >
                            <td >{{$question->name}}</td>
                            <td>{{$question->type->name}}</td>
                            <td >
                                @foreach ($question->answers as $answer)
                                    <li>
                                        {!! $answer->right == 1 ? "<strong>": ""!!}
                                            {{$answer->name}}
                                        {!! $answer->right == 1 ? "</strong>": "" !!}
                                    </li>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
        </div>
    </div>
</div>

	
	
@endsection