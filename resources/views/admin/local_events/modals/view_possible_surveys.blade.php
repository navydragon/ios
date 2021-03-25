<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Создать локальное мероприятие с типом "Анкета"</h4>
</div>
<form method="POST" name="event_form" action="/adm/local_events/add_survey">
  @csrf
<div class="modal-body">
  <h5>1. Выберите анкету</h5>
  <p>В скобках указано количество вопросов в анкете</p>
  <div class="custom-controls-stacked">
  <select name="survey_id" class="custom-select" required>
    <option selected value="">Выберите анкету</option>
    @foreach ($surveys as $elem)
    @if (Auth::user()->admin_access($elem->author->filial_id))
        <option value="{{$elem->id}}">{{$elem->name}} ({{$elem->questions_count}})</option>
    @endif
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. Заполните параметры анкеты</h5>
    <div class="form-group">
      <label class="form-label">Дата, до которой нужно выполнить анкету</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
