@extends('layouts.layout-1')
@php $e_d = $event->description(); @endphp
@section('breadcrumb')
	<li>Управление</li>
	<li>Оценочные сессии</li>
	<li>{{$project_stage->project->name}}</li>
	<li>{{$project_stage->name}}</li>
	<li>{{$e_d->name}}</li>
@endsection

@section('header')
	{{$e_d->name}}: анализ
@endsection


@section('content')
	<div class="card">
		<div class="card-datatable table-responsive">
			<table id="dt_basic" class="table datatables-demo table-striped table-bordered table-hover" width="100%">
				<thead>			                
					<tr class="table-primary">
						<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Ф.И.О.</th>
						<th>Файлов</th>
						<th>Подробнее</th>
						<th>Действия</th>
					</tr>
				</thead>
				<tbody>
					@foreach($project->users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->event_files($event->id)->get()->count()}}</td>
						<td><a href="#data_{{$user->id}}" role="button" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" ariacontrols="data_{{$user->id}}">Подробнее</a>
						<div class="collapse" id="data_{{$user->id}}">
							<div class="panel panel-body no-padding">
								<table class="table table-bordered">
									<tbody>
										@foreach ($user->event_files($event->id)->get() as $event_file)
											<tr>
												<td><a href="/{{$event_file->file->path}}">{{$event_file->file->title}}</a></td>
												<td>{{$event_file->file->type}}</td>
												<td>{{$event_file->created_at}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						</td>
						<td></td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
@endsection

@section('scripts')
<script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>

<script type="text/javascript">
	$('.datatables-demo').dataTable();

</script>
@endsection