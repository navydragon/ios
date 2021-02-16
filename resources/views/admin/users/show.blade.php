@extends('layouts.layout-1')


@section('header')
<a href="/adm/users" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a> Просмотр пользователя {{$user->name}}
@endsection




@section('content')

<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#data">Данные</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#os">Оценочные сессии</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">ID</label>
                    <div class="col-sm-10 col-form-label">
                        {{$user->id}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" required>Фамилия</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->lastname}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" >Имя</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->firstname}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Отчество</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->middlename}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">E-mail (логин для входа)</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->email}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Контактный телефон</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->phone}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Филиал ОАО «РЖД»</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->filial->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Подразделение</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->division}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Должность</label>
                    <div class="col-sm-10 col-form-label font-weight-normal">
                        {{$user->job}}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <a href='/adm/users/{{$user->id}}/edit' class="btn btn-primary">Редактировать</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="os">
            <div class="card-body">
                <h5>Оценочные сессии пользователя</h5>
                <table class="table table-bordered datatables-demo">
                    <thead style="background-color: #333333; color: #fff;">
                        <tr>
                            <th>#</td>
                            <th>Название</th>
                            <th>Сроки проведения</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $idx=1; @endphp
                        @foreach ($user->projects as $project)
                        <tr>
                            <th scope="row">{{$idx}}</th>
                            <td>{{$project->name}}</td>
                            <td>
                                @if ($project->start_date)
                                {{\Carbon\Carbon::createFromTimeStamp(strtotime($project->start_date))->format('d.m.Y H:i:s')}}-{{\Carbon\Carbon::createFromTimeStamp(strtotime($project->end_date))->format('d.m.Y H:i:s')}}
                                @else
                                <i>Не установлены</i>
                                @endif
                            </td>
                            <td><a href="#" class="btn btn-sm btn-info btn-block"><i class="fas fa-eye"></i> Просмотр</a></td>
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


@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection

@section('scripts')
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

    <script type="text/javascript">
        $('.datatables-demo').dataTable();

    </script>
@endsection