<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Создать локальное мероприятие с типом "Методический материал"</h4>
</div>
<form method="POST" name="event_form" action="/adm/local_events/add_material">
  @csrf
<div class="modal-body">
  <h5>1. Выберите методический материал</h5>
  <div class="custom-controls-stacked">
  <select name="material_id" class="custom-select" required>
    <option selected value="">Выберите методический материал</option>
    @foreach ($materials as $elem)
        <option value="{{$elem->id}}">{{$elem->name}}</option>
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. Заполните параметры</h5>
    <div class="form-group">
      <label class="form-label">Дата, до которой нужно изучить методический материал</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
