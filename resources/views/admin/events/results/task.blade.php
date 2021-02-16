<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Просмотр результатов мероприятия</h4>
</div>
<div class="modal-body">
<h5>Задание: {{$task->name}}</h5>
  
  <h5>Пользователь: {{$user->name}}</h5>
  
  <hr> 
  <p>Дата и время последней загрузки выполненного задания: {{\Carbon\Carbon::createFromTimeStamp(strtotime($er->last_activity))->format('d.m.y H:i:s')}}</p>
  <h5>Файлы, загруженные пользователем:</h5>
  <ul class="list-group">
    @foreach ($files as $file) 
    @php $file = $file->file; @endphp
        <li class="list-group-item"><a href="/{{$file->path}}" target="_blank">{{$file->title}}</a> <em>({{\Carbon\Carbon::createFromTimeStamp(strtotime($file->updated_at))->format('d.m.y H:i:s')}})</em></li>
    @endforeach
  </ul> 
</div>
 
  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
  </div>
</div>