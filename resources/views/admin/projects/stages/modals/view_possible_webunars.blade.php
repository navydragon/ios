<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4 class="modal-title">Добавить вебинар в этап: "{{$ps->name}}"</h4>
</div>
<form method="POST" name="event_form" action="/adm/projects/stages/{{$ps->id}}/add_webinar">
  @csrf
<div class="modal-body">
  <h5>1. Выберите вебинар</h5>
  <div class="custom-controls-stacked">
  <select name="case_id" class="custom-select" required>
    <option selected value="">Выберите вебинар</option>
    @foreach ($webinars as $elem)
      @if ($elem->find_in_stage($ps->id)->get()->count() == 0 )
        <option value="{{$elem->id}}">{{$elem->name}}</option>
      @endif
    @endforeach
    </select>    
  </div>
  <hr>
  <div>
    <h5>2. Заполните параметры вебинара</h5>
    <div class="form-group">
      <label class="form-label">Дата, до которой нужно поучаствовать/просмотреть вебинар</label>
      <input type="date" required name="max_date" class="form-control">
    </div>
  </div>
</div>

<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
