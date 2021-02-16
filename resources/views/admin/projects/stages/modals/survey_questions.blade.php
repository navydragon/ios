<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4>Вопрос анкеты: {{$question->body}}</h4>
</div>
<div class="modal-body">

  <table class="table table-bordered">
    <thead>
      <tr class="table-primary">
        <th style="width:20%">Ф.И.О.</th>
        <th>Текст ответа</th>
      </tr>
    </thead>
    <tbody>
       @foreach ($event->survey_attempts as $attempt)
       <tr>
         <td>{{$attempt->user->name}}</td>
         <td>{{$attempt->question_answer($question->id)->answer_text}}</td>
       </tr>
       @endforeach
    </tbody>
  </table>


  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <button  class="btn btn-primary">Экспорт</button>
  </div>
</div>