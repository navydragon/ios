@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>База знаний</li>
    <li>{{$material->name}}</li>
@endsection

@section('header')
{{$material->name}}
@endsection


@section('content')

		
<form method="POST" id="material_form" action="/adm/kn_base/materials/{{$material->id}}">
					@csrf
          {{ method_field('DELETE') }}
          <div class="btn-group">
          <a href="/adm/kn_base/{{$material->category_id}}" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
          <a href="/{{$material->file->path}}" target="_blank" class="btn btn-primary">Скачать материал </a>
          <a href="/adm/kn_base/materials/{{$material->id}}/edit" class="btn btn-info"><i class="fa fa-edit"></i> Редактировать</a>
          <button type="button" onclick="delete_material()" class="btn btn-danger"><i class="fa fa-times"></i> Удалить</button>
          </div>
</form>

<hr>
<div class="row">
  <div class="col-md-6 col-xl-6">
    <h5 class="m-2"> Комментарии</h5>
    @foreach ($material->comments as $comment)
      <div class="card mb-4">
        <div class="card-header">
          <div class="media flex-wrap align-items-center">
            <img src="{{ url('storage/avatars/'.$comment->author->avatar) }}" class="d-block ui-w-40" alt="">
            <div class="media-body ml-3">
              <span>{{$comment->author->name}}</span>
              <div class="text-muted small">{{\Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->format('d.m.Y H:i:s')}}</div>
            </div>
          </div>
        </div>
        <div class="card-body">
          {!! $comment->message !!}
        </div>
      </div>
    @endforeach
  </div>
    <div class="col-md-6 col-xl-6">
        <h5 class="m-2">Добавить комментарий</h5>
      <div class="card mb-4">
        <form id="comment_form" method="POST" action="/adm/kn_base/materials/{{$material->id}}/add_comment">
          @csrf
            <textarea  name="message" class="form-control summernote" rows="10"></textarea>
            
            <div class="m-2">
              <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-check"></i>
                <span>ОТПРАВИТЬ</span>
              </button>
            </div>
        </form>
      </div>
    </div>
</div>


@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/sweetalert2/sweetalert2.css') }}">
	  <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ mix('/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

<script type="text/javascript">
    $('.datatables-demo').dataTable();
    $(function () {
        $('.selectpicker').selectpicker();
    });


    $(document).ready(function() {
        $('.summernote').summernote({height: '250px'});
    });


    function delete_material()
    {
      Swal.fire({
        title: 'Удалить материал?',
        text: '',
        type: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#FFF',
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отмена'
        
      }).then((result) => {
      if (result.value) {
        $('#material_form').submit();
        }
      })
    }
</script>
@endsection