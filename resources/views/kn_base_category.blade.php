@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<div class="" style="padding: 0px; min-height: 93vh;">
<section class="page-header dark page-header-xs">
    <div class="container">
        <div class="session__header">
            <img class="session__img" src="/images/kn-base.png" alt="">
            <h1 class="session__title">База знаний</h1>
        </div>
        <p>все материалы базы знаний сгруппированные по категориям</p>
    </div>
</section>
<div class="container">
    <h3 class="kn-category__title">Категории базы знаний</h3>
    <ul class="kn-category__container">
        @foreach ($categories as $category)
            <li class="kn-category__item">
                <a class="kn-category__item-link" href="/knowledge_base/{{$category->id}}">
                    <img class="kn-category__item-img" src="/images/{{$category->icon}}" alt="">
                    <p class="kn-category__item-name">{{$category->name}}</p>
                    <span class="kn-category__item-count countTo" data-speed="1700">{{$category->materials_count}}</span>
                </a>
            </li>
        @endforeach
        <li class="kn-category__item">
            <a class="kn-category__item-link" href="/knowledge_base/all">
                <img class="kn-category__item-img" src="/images/kn-base-latest.png" alt="">
                <p class="kn-category__item-name">Все материалы</p>
                <span class="kn-category__item-count countTo" data-speed="1700">{{$all_materials_count}}</span>
            </a>
        </li>
    </ul>

    <h3 class="kn-material__title">{{$category_name}}</h3>
    <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal"  data-target="#material_modal"><i class="fa fa-plus"></i> Добавить материал</button>
    <ul class="kn-material__container">
        @foreach ($materials as $material)
        <li class="kn-material__item">
            <img class="kn-material__item-img" src="/images/{{$material->category ? $material->category->icon:'default.png'}}" alt="">
            <div class="kn-material__info">
                <span class="kn-material__item-category">{{$material->category->name ?? ""}}</span>
                <h3 class="kn-material__item-name">{{$material->name}}</h3>
                <ul class="kn-material__tags-container">
                    @foreach($material->tags as $tag)
                    <li class="kn-material__tag">{{$tag->tag}}</li>
                    @endforeach
                </ul>
            </div>
            <a href="/knowledge_base/materials/{{$material->id}}" class="kn-material__button">Подробнее</a>
        </li>
        @endforeach
    </ul>
</div>

</div>

<!--Модальное окно добавления матриала -->
<div class="modal" id="material_modal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить новый материал</h4>
        </div>
      	<form method="POST" enctype="multipart/form-data" action="/knowledge_base/{{$category_id}}/add_material">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg ">Название материала</label>
	                   		<input name="name" class="form-control"  required="">
	                    	<small class="form-text text-muted">Название, как его увидит участник</small>
                		</div>
					</div>
                    <div class="col-md-12">
						<div class="form-group">
						<label class="form-label form-label-lg">Описание:</label>
						<textarea rows="5" required=""  name="description"  class="form-control">

						</textarea>
						<small class="form-text text-muted">Для добавления тэга введите его в поле и нажмите Enter</small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<label class="form-label form-label-lg">Тэги:</label>
						<select multiple data-role="tagsinput" name="tags[]" id="tag_input" class="form-control">

						</select>
						<small class="form-text text-muted">Для добавления тэга введите его в поле и нажмите Enter</small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg">Файл с материалом</label>
	                   		<input name="file" type="file" required="">
	                    	<small class="form-text text-muted">Выберите файл на ПК и нажмите кнопку "Добавить".</small>
                		</div>
					</div>
				</div>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Добавить</button>
	        </div>
	    </form>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
@endsection