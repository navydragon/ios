<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Просмотр результатов мероприятия</h4>
</div>
<div class="modal-body">
<h5>Учебный материал: {{$lm->name}}</h5>
  
  <h5>Пользователь: {{$user->name}}</h5>
  
  <hr> 
  <p>Дата и время последнего обращения к учебному материалу: {{\Carbon\Carbon::createFromTimeStamp(strtotime($er->last_activity))->format('d.m.y H:i:s')}}</p>
 
</div>
 
  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <!-- <a href="/adm/docx/user_case/{{$event->id}}/{{Auth::user()->id}}"  class="btn btn-primary">Экспорт</a> -->
  </div>
</div>