<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Создать локальное мероприятие с типом "Тест"</h4>
</div>
<form method="POST" name="event_form" action="/adm/local_events/add_test">
  @csrf
<div class="modal-body">
  <h5>1. Выберите тест</h5>
  <p>В скобках указано максимальное количество вопросов</p>
  <div class="custom-controls-stacked">
  <select name="test_id" class="custom-select" required>
    <option selected value="">Выберите тест</option>
    @foreach ($tests as $elem)
    @if (Auth::user()->admin_access($elem->author->filial_id))
        <option value="{{$elem->id}}">{{$elem->name}} ({{$elem->questions_count}})</option>
    @endif
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. Заполните параметры теста</h5>
    <div class="form-group">
      <label class="form-label">Количество вопросов в тесте</label>
      <input type="number" required name="show_questions" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">Количество вопросов для зачета</label>
      <input type="number" required name="passing_score" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">Максимальное количество попыток</label>
      <input type="number" required name="max_attempts" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">Время на одну попытку (минут)</label>
      <input type="number" required name="attempt_time" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-label">Дата, до которой нужно выполнить тест</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
