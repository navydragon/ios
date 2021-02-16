@extends('layouts.layout-1')



@section('header')
	{{$lm->name}} 
@endsection


@section('content')
<div class="nav-tabs-top">
<ul class="nav nav-tabs">
    <li>
        <a href="/adm/learning_modules" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active show" id="data">
        <div class="card-body">
            <form action="/adm/learning_modules/{{$lm->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label form-label-lg">Название</label>
                <input type="text" class="form-control" value="{{$lm->name}}" placeholder="" name="name" required="">
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Описание</label>
                <textarea class="form-control" placeholder=""  rows="5" name="description">{{$lm->description}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label form-label-lg">Путь к файлу</label>
                <input type="text" class="form-control" value="{{$lm->path}}" placeholder="" name="path" required="">
            </div>
            @if (Auth::user()->role_id == 1)
                <div class="form-group">
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_recommend" {{$lm->is_recommend ? "checked": ""}}>
                    <div class="form-check-label">
                        Является рекомендованным для изучения
                    </div>
                    </label>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="fas fa-save"></span> Сохранить</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
	


@endsection

@section('scripts')
<script type="text/javascript">
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });


</script>


@if (\Session::has('success'))
    <script>
        toastr.success('{!! \Session::get('success') !!}', 'Успех!',{"positionClass": "toast-bottom-right",})
    </script>
@endif

@endsection