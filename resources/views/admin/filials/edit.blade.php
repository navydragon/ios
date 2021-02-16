@extends('layouts.layout-1')


@section('header')
<a href="/adm/filials" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a> Редактирование филиала {{$filial->name}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{mix('/vendor/libs/toastr/toastr.css')}}">
    
@endsection


@section('content')

<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#data">Данные</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#access">Пользователи</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <form method="POST" action="/adm/filials/{{$filial->id}}/edit">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">ID</label>
                        <div class="col-sm-10">
                            {{$filial->id}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" required>Название</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Название" value="{{$filial->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" required>Краткое название</label>
                        <div class="col-sm-10">
                            <input type="text" name="shortname" class="form-control" placeholder="Краткое название" value="{{$filial->shortname}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="access">
            <div class="card-body">
            <h5>Пользователи, прикрепленные к филиалу</h5>
            <table class="table table-bordered datatables-demo">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Ф.И.О.</th>
                            <th>Подразделение</th>
                            <th>Должность</th>
                            <th>Контакты</th>
                            <th>Действия</th>
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
                            <td></td>
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
<script type="text/javascript"> $('.datatables-demo').dataTable();</script>
<script src="{{mix('/vendor/libs/toastr/toastr.js')}}"></script>


@if (\Session::has('success_update'))
    <script>
        toastr.success('{!! \Session::get('success_update') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection