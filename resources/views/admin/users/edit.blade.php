@extends('layouts.layout-1')


@section('header')
<a href="/adm/users" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a> Редактирование пользователя {{$user->name}}
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
        <a class="nav-link" data-toggle="tab" href="#access">Доступ</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <form method="POST" action="/adm/users/{{$user->id}}/update">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">ID</label>
                        <div class="col-sm-10">
                            {{$user->id}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" required>Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastname" class="form-control" placeholder="Фамилия" value="{{$user->lastname}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right" >Имя</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstname" class="form-control" value="{{$user->firstname}}" placeholder="Имя" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Отчество</label>
                        <div class="col-sm-10">
                            <input type="text" name="middlename" class="form-control" value="{{$user->middlename}}" placeholder="Отчество" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">E-mail (логин для входа)</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="E-mail" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Контактный телефон</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Телефон" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Филиал ОАО «РЖД»</label>
                        <div class="col-sm-10">
                            <select id="filial_id"  name="filial_id" value="{{ $user->filial_id }}" class="custom-select form-control" required >
                                <option value="">Не выбрано</option> 
                                @foreach($filials as $filial)
                                @if ( $user->filial_id == $filial->id)
                                    <option value="{{$filial->id}}" selected>{{$filial->name}}</option>
                                @else
                                    <option value="{{$filial->id}}">{{$filial->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Подразделение</label>
                        <div class="col-sm-10">
                            <input type="text" name="division" class="form-control" value="{{$user->division}}" placeholder="Подразделение" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Должность</label>
                        <div class="col-sm-10">
                            <input type="text" name="job" class="form-control" value="{{$user->job}}" placeholder="Должность" required>
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
            <h5>Роль в системе</h5>
            <form method="POST" action="/adm/users/{{$user->id}}/update_role">
                @csrf
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Роль доступа в системе</label>
                    <div class="col-sm-10">
                        <select id="role_id"  name="role_id" value="{{ $user->role_id }}" class="custom-select form-control" required >
                            <option value="">Не выбрано</option> 
                            @foreach($roles as $role)
                            @if ( $user->role_id == $role->id)
                                <option value="{{$role->id}}" selected>{{$role->name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
            <hr>
            <h5>Пароль пользователя</h5>
            <form method="POST" action="/adm/users/{{$user->id}}/reset_password">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12 ml-sm-auto">
                        <button type="submit" class="btn btn-info">Сбросить пароль</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{mix('/vendor/libs/toastr/toastr.js')}}"></script>
@if (\Session::has('success_role'))
    <script>
        toastr.success('{!! \Session::get('success_role') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
        $('a[href="#access"]').tab('show')
    </script>
@endif

@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection