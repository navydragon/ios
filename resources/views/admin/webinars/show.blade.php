@extends('layouts.layout-1')


@section('header')
	{{$webinar->name}}
@endsection


@section('content')
<ul class="nav nav-tabs">
    <li>
        <a href="/adm/webinars" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#participation">Участие</a>
    </li>
</ul>
<div class="card">
<div class="card-body">
<div class="tab-content">
    <div class="tab-pane fade active show" id="data">
        <div class="card-body">
            <h5>Основные параметры</h5>
            <div class="form-group ">
                <label class="form-label form-label-lg">Описание</label>
                <div>{!! $webinar->description !!}</div>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Дата и время проведения</label>
                <div>{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->format('d.m.y H:i:s')}}</div>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на вход для участников</label>
                <div><a href="{{$webinar->url}}">{{$webinar->url}}</a></div>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на вход для администратора</label>
                <div><a href="{{$webinar->admin_url}}">{{$webinar->admin_url}}</a></div>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на запись</label>
                <div><a href="{{$webinar->recording_url}}">{{$webinar->recording_url}}</a></div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="participation">
        <div class="card-body">
            <h5>Участие пользователей в вебинаре</h5>
            <table class="table table-bordered datatables-demo">
                <thead style="background-color: #333333; color: #fff;">
                    <tr><th>Пользователь</th><th>Тип</th><th>Дата и время</th></tr>
                </thead>
                <tbody>
                    @foreach ($participations as $elem)
                    <tr>
                    <td>{{$elem->user->name}}</td>
                    <td>{{$elem->type}}</td>
                    <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($elem->participation_date))->format('d.m.Y H:i:s')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
</div>
</div>
@endsection

@section('scripts')
<script>
    $('.datatables-demo').dataTable();
</script>
@endsection
