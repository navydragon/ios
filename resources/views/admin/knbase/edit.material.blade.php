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
          <a href="/{{$material->file->path}}" target="_blank" class="btn btn-primary">Скачать материал </a>
          <a href="/adm/kn_base/materials/{{$material->id}}/edit" class="btn btn-info"><i class="fa fa-edit"></i> Редактировать</a>
					<button type="button" onclick="delete_material()" class="btn btn-danger"><i class="fa fa-times"></i> Удалить</button>
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
            <div id="message-editor-toolbar">
                <span class="ql-formats">
                  <select class="ql-font"></select>
                  <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-bold"></button>
                  <button class="ql-italic"></button>
                  <button class="ql-underline"></button>
                  <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                  <select class="ql-color"></select>
                  <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-script" value="sub"></button>
                  <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-header" value="1"></button>
                  <button class="ql-header" value="2"></button>
                  <button class="ql-blockquote"></button>
                  <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-list" value="ordered"></button>
                  <button class="ql-list" value="bullet"></button>
                  <button class="ql-indent" value="-1"></button>
                  <button class="ql-indent" value="+1"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-direction" value="rtl"></button>
                  <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-link"></button>
                  <button class="ql-image"></button>
                  <button class="ql-video"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-clean"></button>
                </span>
            </div>
            <div id="message-editor" style="height: 300px"></div>
            <textarea name="message" style="display:none" id="hiddenArea"></textarea>
            <textarea id="message-editor-fallback" class="form-control d-none" style="height: 200px"></textarea>
            
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
    <link rel="stylesheet" href="{{ mix('/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/sweetalert2/sweetalert2.css') }}">
	  <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ mix('/vendor/libs/quill/quill.js') }}"></script>
<script src="{{ mix('/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

<script type="text/javascript">
    $('.datatables-demo').dataTable();
    $(function () {
        $('.selectpicker').selectpicker();
    });

    if (!window.Quill) {
      $('#message-editor,#message-editor-toolbar').remove();
      $('#message-editor-fallback').removeClass('d-none');
    } else {
      $('#message-editor-fallback').remove();
      quill = new Quill('#message-editor', {
        modules: {
          toolbar: '#message-editor-toolbar'
        },
        placeholder: 'Напишите Ваше сообщение...',
        theme: 'snow'
      });
      $("#comment_form").on("submit",function(){
        var myEditor = document.querySelector('#message-editor')
        var html = myEditor.children[0].innerHTML
        $("#hiddenArea").val(html) 
      })
    }

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