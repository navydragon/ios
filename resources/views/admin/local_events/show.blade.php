@extends('layouts.layout-1')



@section('header')
	Локальное мероприятия «{{$ev->name}}» 
@endsection


@section('content')
<div class="nav-tabs-top">
    <ul class="nav nav-tabs">
        <li>
            <a href="/adm/local_events" class="btn btn-default"><span class="fas fa-caret-left"></span> Назад</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data">Основные параметры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#results">Результаты прохождения</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="data">
            <div class="card-body">
              <div class="form-group">
                <h5>Название</h5>
                <div>{{$ev->name}}</div>
              </div>
              <div class="form-group">
                <h5>Тип</h5>
                <div>{{$ev->type}}</div>
              </div>
              <hr>
              <div class="form-group">
                <h5>Дата, до которой открыто мероприятие</h5>
                <div>{{\Carbon\Carbon::createFromTimeStamp(strtotime($ep->max_date))->format('d.m.Y')}}</div>
              </div>
              @if ($event->event_type_id == 3)
                <div class="form-group">
                  <h5>Количество вопросов в тесте</h5>
                  <div>{{$ep->show_questions}}</div>
                </div>
                <div class="form-group">
                  <h5>Количество вопросов для зачета</h5>
                  <div>{{$ep->passing_score}}</div>
                </div>
                <div class="form-group">
                  <h5>Максимальное количество попыток</h5>
                  <div>{{$ep->max_attempts}}</div>
                </div>
                <div class="form-group">
                  <h5>Время на одну попытку (минут)</h5>
                  <div>{{$ep->attempt_time}}</div>
                </div>
              @endif
            </div>
        </div>
        <div class="tab-pane fade" id="results">
            <div class="card-body">
                <table class="table table-bordered datatables-demo">
                    <thead>
                    <tr><th>Пользователь</th><th>Результат</th>
                    <th>Дата последней активности</th>
                    @if ($event->event_type_id != 2)
                    <th>Подробнее</th>
                    @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($event->event_results as $result)
                    <tr>
                    <td>{{$result->user->name}}</td>
                    <td>{{$result->is_passed == 1 ? "пройден": ""}}</td>
                    <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($result->last_activity))->format('d.m.y H:i:s')}}</td>
                    @if ($event->event_type_id != 2)
                        <td><a href="#" data-toggle="modal" data-remote="/adm/events/{{$event->id}}/results/{{$result->user->id}}"  data-target="#myModal" class="btn btn-primary">Подробнее</a></td>
                    @endif
                    </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
	

	
			
<div class="modal" id="myModal">
	<div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Просмотр результатов локального мероприятия</h4>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')

	
<script type="text/javascript">
$('.datatables-demo').dataTable();
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