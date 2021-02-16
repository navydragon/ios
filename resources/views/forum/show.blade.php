@extends('layouts.app')

@section('content')

<div class="container" style="padding: 50px 0px; min-height: 82vh;">

    <div class="test__header">
        <img class="test__img" src="/images/forum.png" alt="">
        <div class="test__info">
            <h3 class="test__title">{{$forum->name}}</h3>
            <p class="test__subtitle">Выберите тему и начните общение</p>
        </div>
    </div>
	
		<table class="table table-vertical-middle margin-bottom-60">
			<thead>
				<tr class="size-15 table__header">
					<th class="table__header-item">Темы</th>
					<th class="table__header-item text-center">Сообщения</th>
					<th class="table__header-item text-center">Последнее обновление</th>
                    <th class="table__header-item text-center">Последний автор</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($forum->threads as $thread)
				<tr>
					<td>
						<h4 class="nomargin size-16">
							<a href="/forums/{{$forum->id}}/threads/{{$thread->id}}">
								{{$thread->name}}
							</a>
						</h4>
					</td>
					<td class="hidden-xs text-center">{{$thread->messages->count()}}</td>
					<td class="hidden-xs text-center">{{\Carbon\Carbon::createFromTimeStamp(strtotime($thread->last_message()->updated_at))->format('d.m.Y H:i:s')}}</td>
                    <td class="hidden-xs text-center">{{$thread->last_message()->author->name}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	<!-- /FORUM 1 -->
		<div class="clearfix margin-bottom-60">

			<h4 class="test__title" style="padding-bottom: 15px;">Создать тему</h4>
			
			<form method="POST" action="/forums/{{$forum->id}}/threads">
				@csrf
				<div class="form-group">
					<div class="">
						<label class="test__subtitle">Название темы *</label>
						<input name="name" value="" required class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="">
						<label class="test__subtitle">Текст сообщения *</label>
						<textarea name="message_text" class="summernote form-control" data-height="200" ></textarea>
					</div>
				</div>
				<div class="">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-plus"></i>
						<span>СОЗДАТЬ</span>
					</button>
				</div>


			</form>

		</div>
</div>


@endsection