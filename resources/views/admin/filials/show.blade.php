@extends('layouts.layout-1')


@section('header')
<a href="/adm/filials" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a> Просмотр филиала  {{$filial->name}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection


@section('content')

<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#data">Основная информация</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#users">Пользователи</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">ID</label>
                    <div class="col-sm-10 col-form-label">
                        {{$filial->id}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" required>Фамилия</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$filial->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <a href='/adm/filials/{{$filial->id}}/edit' class="btn btn-primary">Редактировать</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="users">
            <div class="card-body">
                <table class="table table-bordered datatables-demo">
                    <thead style="background-color: #333333; color: #fff;">
                        <tr>
                            <th>#</td>
                            <th>Ф.И.О.</th>
                            <th>Подразделение</th>
                            <th>Должность</th>
                            <th>Контакты</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $idx=1; @endphp
                        @foreach ($filial->users as $user)
                        <tr>
                            <th scope="row">{{$idx}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->division}}</td>
                            <td>{{$user->job}}</td>
                            <td>{{$user->email}}<br>{{$user->phone}}</td>
                        </tr>
                        @php $idx++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection


@section('scripts')
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

    <script type="text/javascript">
        $('.datatables-demo').dataTable();

    </script>
@endsection