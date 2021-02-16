@extends('layouts.layout-1')


@section('header')
	Редактирование вебинара «{{$webinar->name}}»
@endsection


@section('content')
<div>
    <a href="/adm/webinars" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="/adm/webinars/{{$webinar->id}}" method="POST">
            @csrf
            <h5>Основные параметры</h5>
            <div class="form-group">
                <label class="form-label form-label-lg">Название</label>
                <input type="text" class="form-control" value="{{$webinar->name}}" placeholder="" name="name" required="">
            </div>
            <div class="form-group ">
                <label class="form-label form-label-lg">Описание</label>
                <textarea class="form-control" placeholder=""  rows="5" name="description">{!! $webinar->description !!}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Дата и время проведения</label>
                <input type="datetime-local" class="form-control" value="{{\Carbon\Carbon::createFromTimeStamp(strtotime($webinar->start_date))->toDatetimelocalString()}}" placeholder="" name="start_date" required="">
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на вход для участников</label>
                <input type="text" class="form-control" value="{{$webinar->url}}" placeholder="" name="url" required="">
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на вход для администратора</label>
                <input type="text" class="form-control" value="{{$webinar->admin_url}}" placeholder="" name="admin_url" required="">
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Ссылка на запись</label>
                <input type="text" class="form-control" value="{{$webinar->recording_url}}" placeholder="" name="recording_url" required="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>  
    </div>
</div>
@endsection


@section('scripts')
@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif
@endsection
