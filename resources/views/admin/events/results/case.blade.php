<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Просмотр результатов мероприятия</h4>
</div>
<div class="modal-body">
<h5>Кейс: {{$case->name}}</h5>
  
  <h5>Пользователь: {{$user->name}}</h5>
  
  <hr> 
  <p>Дата и время последнего обновления ответов на кейс: {{\Carbon\Carbon::createFromTimeStamp(strtotime($er->last_activity))->format('d.m.y H:i:s')}}</p>
  <h5>Ответы на кейс:</h5>
  @foreach($case_tasks as $task)
    @php $uct = $task->user_answer($user->id,$event->id); @endphp
    <h5>Задание № {{$task->sort}}</h5> 
    <div class="mb-2">{!! $uct->first()->pivot->answer !!}</div> 
  @endforeach 
  <h5>Возможные ошибки</h5>
  <div class="mb-2"></div> 
  <div class="mb-2">{!! count($case_results) > 0 ? $case_results->first()->possible_errors : '' !!}</div> 
  <h5>Последствия ошибок</h5>
  <div class="mb-2">{!! count($case_results) > 0 ? $case_results->first()->error_effects : '' !!}</div> 
  <h5>Алгоритмы</h5>
  <div class="mb-2">{!! count($case_results) > 0 ? $case_results->first()->algorithms : '' !!}</div> 
  <h5>Выводы</h5>
  <div class="mb-2">{!! count($case_results) > 0 ? $case_results->first()->conclusions : '' !!}</div> 
</div>
 
  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <a href="/adm/docx/user_case/{{$event->id}}/{{Auth::user()->id}}"  class="btn btn-primary">Экспорт</a>
  </div>
</div>