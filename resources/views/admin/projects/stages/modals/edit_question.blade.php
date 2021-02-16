<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4>Редактирование вопроса</h4>
</div>
<form method="POST" name="question_form_edit" action="/adm/questions/{{$question->id}}/update">
  @csrf
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Текст вопроса:</label>
        <input type="text" class="form-control" name="edit_name" placeholder="" value="{{$question->name}}" required />
      </div>
      <div class="form-group">
        <p>Тип вопроса:</p>
          
          <p><input type="radio" name="edit_type" value="1" {{$question->type_id == 1 ? "checked" : ""}}> <label>Единичный выбор</label></p>
          <p><input type="radio" name="edit_type" value="2" {{$question->type_id == 2 ? "checked" : ""}}> <label>Множественный выбор</label></p>
          <p><input type="radio" name="edit_type" value="3" {{$question->type_id == 3 ? "checked" : ""}}> <label>Текстовый ввод</label></p>
      </div>

      <div class="form-group">
        <h4>Текущие варианты ответов</h4>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="80%">Текст ответа</th>
            <th>Правильность</th>
          </tr>
        </thead>
          <tbody>
                @foreach ($question->answers as $answer)
                <tr>
                  <td><input type="text" name="c_t[{{$answer->id}}]" value="{{$answer->name}}" class="form-control"></td>
                  <td class="text-center"><input type="checkbox" name="c_r[{{$answer->id}}]" {{$answer->right == 1 ? "checked" : ""}}></input></td>
                </tr>
        
                @endforeach
              </tbody>
      </table>
    </div>
  </div>
</div>




<div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
    <button type="submit"  class="btn btn-primary">Добавить</button>   
</div>
</form>
