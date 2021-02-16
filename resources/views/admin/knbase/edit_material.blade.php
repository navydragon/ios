@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>База знаний</li>
    <li>{{$material->name}}</li>
@endsection

@section('header')
Редактирование: {{$material->name}}
@endsection


@section('content')
<div class="card mb-4">
<form method="POST" enctype="multipart/form-data" action="/adm/kn_base/materials/{{$material->id}}/update">
			@csrf
      <div class="col-md-12 mt-2">
        <div class="form-group">
            <label class="form-label form-label-lg w-100">Название материала</label>
            <input name="name" value="{{$material->name}}" class="form-control"  required="">
            <small class="form-text text-muted">Название, как его увидит участник</small>
        </div>
      </div>
      <div class="col-md-12">
        <label class="form-label form-label-lg w-100">Категория</label>
        <div class="form-group">
          <select class="selectpicker" name="category_id" data-style="btn-default">
            @foreach ($categories as $category)
            @if ($material->category_id == $category->id)
            <option selected value="{{$category->id}}">{{$category->name}}</option>
            @else
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-12 mt-2">
        <div class="form-group">
            <label class="form-label form-label-lg w-100">Описание</label>
            <textarea name="description" rows="5" class="form-control"  required="">{!! $material->description !!}</textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
        <label class="form-label form-label-lg w-100">Тэги</label>
        <select multiple data-role="tagsinput" name="tags[]" id="tag_input" class="form-control">
          @foreach ($material->tags as $tag)
            <option value="{{$tag->tag}}">{{$tag->tag}}</option>
          @endforeach
        </select>
        <small class="form-text text-muted">Для добавления тэга введите его в поле и нажмите Enter</small>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label form-label-lg w-100">Файл с материалом</label>
          <div><a href="/{{$material->file->path}}" target="_blank" class="btn btn-info">Скачать материал </a></div>
          <hr>
          <label class="form-label form-label-lg w-100">Заменить файл</label>
          <input name="file" type="file">
          <small class="form-text text-muted">Если необходимо заменить файл, выберите файл новый файл на ПК.</small>
        </div>
      </div>
      <button type="submit" class="btn btn-primary form-control">Сохранить</button>
</form>
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