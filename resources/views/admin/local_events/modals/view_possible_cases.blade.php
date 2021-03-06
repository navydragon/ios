<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Создать локальное мероприятие с типом "Кейс"</h4>
</div>
<form method="POST" name="event_form" action="/adm/local_events/add_case">
  @csrf
<div class="modal-body">
  <h5>1. Выберите кейс</h5>
  <div class="custom-controls-stacked">
  <select name="case_id" class="custom-select" required>
    <option selected value="">Выберите кейс</option>
    @foreach ($cases as $elem)
    @if (Auth::user()->admin_access($elem->author->filial_id))
        <option value="{{$elem->id}}">{{$elem->name}}</option>
    @endif
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. Заполните параметры кейса</h5>
    <div class="form-group">
      <label class="form-label">Дата, до которой нужно выполнить кейс</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
