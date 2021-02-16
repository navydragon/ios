@extends('layouts.app')

@section('content')


<div class="container" style="margin-top: 50px;">
	<div class="col-md-3">
		<div class="thumbnail text-center">
			<img class="img-fluid" id="photo_main" src="{{ url('storage/avatars/'.Auth::user()->avatar) }}"  alt="" />
			<h2 class="size-18 margin-top-10 margin-bottom-0">{{ Auth::user()->name }}</h2>
			<h3 class="size-12 margin-top-0 margin-bottom-10 text-muted">{{ Auth::user()->role->name }}</h3>
            <h3 class="size-12 margin-top-0 margin-bottom-10 text-muted">{{ Auth::user()->filial->name }}</h3>
		</div>

		<ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
			<!--<li class="list-group-item "><a href="#"><i class="fa fa-eye"></i> ПРОФИЛЬ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-tasks"></i> ОБУЧЕНИЕ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-comments-o"></i> СООБЩЕНИЯ</a></li>
			<li class="list-group-item"><a href="#"><i class="fa fa-history"></i>ЗАГРУЗКИ</a></li> -->
            <li class="list-group-item active"><a href="/user_settings"><i class="fa fa-gears"></i> НАСТРОЙКИ</a></li>
            <li class="list-group-item"><a href="/user_projects"><i class="fa fa-users"></i> ОЦЕНОЧНЫЕ СЕССИИ</a></li>
            <li class="list-group-item"><a href="/user_local"><i class="fa fa-calendar"></i> ЛОКАЛЬНЫЕ МЕРОПРИЯТИЯ</a></li>
            <li class="list-group-item"><a href="/user_dialogs"><i class="fa fa-comment"></i> СООБЩЕНИЯ</a></li>
            
		</ul>
	</div>

	<div class="col-md-9">
		<h3>Настройки</h3>
		@if(session()->has('success'))
    		<div class="alert alert-success">
        		{{ session()->get('success') }}
    		</div>
		@endif
		@if(session()->has('error'))
    		<div class="alert alert-danger">
        		{{ session()->get('error') }}
    		</div>
		@endif
		<ul class="nav nav-tabs nav-top-border">
			<li class="active"><a href="#info" data-toggle="tab">Контактная информация</a></li>
			<li><a href="#avatar" data-toggle="tab">Фото</a></li>
			<li><a href="#password" data-toggle="tab">Пароль</a></li>
			<!--<li><a href="#privacy" data-toggle="tab">Личные настройки</a></li>-->
		</ul>

		<div class="tab-content margin-top-20">

			<!-- PERSONAL INFO TAB -->
			<div class="tab-pane fade in active" id="info">
				<form action="/update_personal_info" method="post">
					@csrf
					<div class="form-group">
						<label class="control-label">Ф.И.О.</label>
						<input type="text" required name="name"  value="{{Auth::user()->name}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">E-mail (логин)</label>
						<input type="text" required name="email" value="{{Auth::user()->email}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Контактный телефон</label>
						<input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Служба/отдел</label>
						<input type="text" id="phone" name="division" value="{{Auth::user()->division}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Должность</label>
						<input type="text" id="phone" name="job" value="{{Auth::user()->job}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Дополнительный e-mail</label>
						<input type="text" id="phone" name="additional_email" value="{{Auth::user()->additional_email}}" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Дополнительный телефон</label>
						<input type="text" id="phone" name="additional_phone" value="{{Auth::user()->additional_phone}}" class="form-control">
					</div>
					
					<div class="margiv-top10">
						<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Сохранить изменения </button>
						
					</div>
				</form>
			</div>
			<!-- /PERSONAL INFO TAB -->

			<!-- AVATAR TAB -->
			<div class="tab-pane fade" id="avatar">
				<form id="photo_form" class="clearfix" method="post" enctype="multipart/form-data" action="/user_avatar">
					@csrf
					<div class="form-group">

						<div class="row">

							<div class="col-md-3 col-sm-4">

								<div class="thumbnail">
									<img class="img-responsive" id="photo_mini" src="{{ url('storage/avatars/'.Auth::user()->avatar) }}" alt="" />
								</div>

							</div>

							<div class="col-md-9 col-sm-8">

								<div class="sky-form nomargin">
									<label class="label">Выберите файл</label>
									<label for="file" class="input input-file">
										<div class="button">
											<input type="file" name="avatar" id="file" accept="image" onchange="this.parentNode.nextSibling.value = this.value">Обзор...
										</div><input type="text" readonly>
									</label>
								</div>

							
								

							</div>

						</div>

					</div>

					<div class="margiv-top10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Сохранить изменения </button>
						<a href="/delete_avatar" class="btn btn-default">Удалить фото </a>
					</div>

				</form>

			</div>
			<!-- /AVATAR TAB -->

			<!-- PASSWORD TAB -->
			<div class="tab-pane fade" id="password">
				<form id="pass_form" action="/change_password" method="POST">
					@csrf
					<div class="form-group">
						<label class="control-label">Текущий пароль</label>
						<input type="password" name="current_pass" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Новый пароль</label>
						<input type="password" name="new_pass" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Повторите новый пароль</label>
						<input type="password" name="new_pass_repeat" class="form-control">
					</div>
				
					<div class="margiv-top10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Изменить пароль</button>
					</div>
				</form>
			</div>
			<!-- /PASSWORD TAB -->

			<!-- PRIVACY TAB -->
			<div class="tab-pane fade" id="privacy">

				<form action="#" method="post">
					<div class="sky-form">

						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
									<td>
										<div class="inline-group">
											<label class="radio nomargin-top nomargin-bottom">
												<input type="radio" name="radioOption" checked=""><i></i> Yes
											</label>

											<label class="radio nomargin-top nomargin-bottom">
												<input type="radio" name="radioOption" checked=""><i></i> No
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
									<td>
										<label class="checkbox nomargin">
											<input type="checkbox" name="checkbox" checked=""><i></i> Yes
										</label>
									</td>
								</tr>
								<tr>
									<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
									<td>
										<label class="checkbox nomargin">
											<input type="checkbox" name="checkbox" checked=""><i></i> Yes
										</label>
									</td>
								</tr>
								<tr>
									<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
									<td>
										<label class="checkbox nomargin">
											<input type="checkbox" name="checkbox" checked=""><i></i> Yes
										</label>
									</td>
								</tr>
							</tbody>
						</table>

					</div>

					<div class="margin-top-10">
						<a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Сохранить изменения </a>
						<a href="#" class="btn btn-default">Отмена </a>
					</div>

				</form>

			</div>
			<!-- /PRIVACY TAB -->	
		</div>
	</div>
</div>
@endsection