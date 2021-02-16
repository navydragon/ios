@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
	<li>База знаний</li>
@endsection

@section('header')
	База знаний
@endsection


@section('content')

<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card mb-4">
            <h6 class="card-header">Выберите категорию
            <button type="button" class="btn btn-primary btn-sm pull-right"  data-toggle="modal"  data-target="#myModal"><i class="fa fa-plus"></i> Добавить</button>
            </h6>
            <div class="card-body">
            <div class="dropdown"  id="nesting-dropdown-demo">
                <button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Без категории</button>
                <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="/adm/kn_base/">Без категории</a>
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="/adm/kn_base/{{$category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->

<!--Модальное окно добавления категории -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить новую категорию базы знаний</h4>
        </div>
      	<form method="POST" action="/adm/knbase_category">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                    		<label class="form-label form-label-lg">Название</label>
                    		<input type="text" class="form-control " placeholder="" name="name" required="">
                		</div>
						<div class="form-group">
							<label class="form-label form-label-lg">Родительская категория (необязательно):</label>
							<select name="parent_id" class="selectpicker" data-style="btn-default">
                                <option value="">Нет</option>
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
						</div>
					</div>
				</div>
        	</div>
	        <div class="modal-footer">
	          <a href="#" data-dismiss="modal" class="btn">Отмена</a>
	          <button type="submit" class="btn btn-primary">Создать</button>
	        </div>
	    </form>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card mb-4">
            <h4 class="m-4">Материалы без категории</h4>
			<div class="ml-4 pull-right">
				<form method="POST" id="category_form" action="#">
					@csrf
					{{ method_field('DELETE') }}
					<button type="button" class="btn btn-sm btn-primary"  data-toggle="modal"  data-target="#material_modal"><i class="fa fa-plus"></i> Добавить материал</button>
				</form>
			</div>
            <div class="card-datatable table-responsive">
            <table id="dt_basic" class="table datatables-demo table-striped table-bordered table-hover" width="100%">
				<thead style="background-color: #333333; color: #fff;">			                
					<tr class="table-primary">
						<th>ID</th>
						<th class="w-75">Название</th>
						<th >Просмотр</th>
					</tr>
				</thead>
				<tbody>
					@foreach($materials as $material)
					<tr>
						<td>{{$material->id}}</td>
						<td>{{$material->name}}</td>
						<td>
							<a href="/adm/kn_base/materials/{{$material->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Просмотреть</a>
						</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
            </div>
        </div>
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
      	<form method="POST" enctype="multipart/form-data" action="/adm/knbase/all/add_material">
			@csrf
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Название материала</label>
	                   		<input name="name" class="form-control"  required="">
	                    	<small class="form-text text-muted">Название, как его увидит участник</small>
                		</div>
					</div>
                    <div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Описание</label>
	                   		<textarea name="description" class="form-control" required=""></textarea>
                		</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<label class="form-label form-label-lg w-100">Тэги:</label>
						<select multiple data-role="tagsinput" name="tags[]" id="tag_input" class="form-control">

						</select>
						<small class="form-text text-muted">Для добавления тэга введите его в поле и нажмите Enter</small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
	                    	<label class="form-label form-label-lg w-100">Файл с материалом</label>
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

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>


<script type="text/javascript">
    $('.datatables-demo').dataTable();
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
@endsection