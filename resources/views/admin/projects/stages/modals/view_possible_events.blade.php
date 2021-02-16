<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Добавить мероприятие в этап: "{{$ps->name}}"</h4>
</div>
<form method="POST" name="event_form" action="/adm/projects/stages/{{$ps->id}}/add_event">
  @csrf
<div class="modal-body">
  <h4>Анкеты</h4>
  <div class="custom-controls-stacked">
    @foreach ($surveys as $elem)
      <label class="custom-control custom-radio">
        <input name="radio" value="su{{$elem->id}}" type="radio" class="custom-control-input" {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : 'disabled="disabled"'}}>
        <span class="custom-control-label">{{$elem->name}} {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : '(уже добавлено)'}}</span>
      </label>
    @endforeach
  </div>
  <h4>Тесты</h4>
  <div class="custom-controls-stacked">
    @foreach ($tests as $elem)
      <label class="custom-control custom-radio">
        <input name="radio" value="te{{$elem->id}}" type="radio" class="custom-control-input" {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : 'disabled="disabled"'}}>
        <span class="custom-control-label">{{$elem->name}} {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : '(уже добавлено)'}}</span>
      </label>
    @endforeach
  </div>
  <h4>Задания</h4>
  <div class="custom-controls-stacked">
    @foreach ($tasks as $elem)
      <label class="custom-control custom-radio">
        <input name="radio" value="ta{{$elem->id}}" type="radio" class="custom-control-input" {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : 'disabled="disabled"'}}>
        <span class="custom-control-label">{{$elem->name}} {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : '(уже добавлено)'}}</span>
      </label>
    @endforeach
  </div>
  <h4>Учебные материалы</h4>
  <div class="custom-controls-stacked">
    @foreach ($learning_modules as $elem)
      <label class="custom-control custom-radio">
        <input name="radio" value="lm{{$elem->id}}" type="radio" class="custom-control-input" {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : 'disabled="disabled"'}}>
        <span class="custom-control-label">{{$elem->name}} {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : '(уже добавлено)'}}</span>
      </label>
    @endforeach
  </div>
  <h4>Вебинары</h4>
  <div class="custom-controls-stacked">
    @foreach ($learning_modules as $elem)
      <label class="custom-control custom-radio">
        <input name="radio" value="we{{$elem->id}}" type="radio" class="custom-control-input" {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : 'disabled="disabled"'}}>
        <span class="custom-control-label">{{$elem->name}} {{$elem->find_in_stage($ps->id)->get()->count() == 0 ? '' : '(уже добавлено)'}}</span>
      </label>
    @endforeach
  </div>    
      
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
