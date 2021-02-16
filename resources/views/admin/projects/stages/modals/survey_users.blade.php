<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4>Ответы: {{$user->name}}</h4>
</div>
<div class="modal-body">

  <table class="table table-bordered">
    <thead>
      <tr class="table-primary">
        <th style="width:40%">Вопрос</th>
        <th>Текст ответа</th>
      </tr>
    </thead>
    <tbody>
       @foreach ($user->survey_attempts_in_event($event->id) as $attempt)
        @foreach ($attempt->answers as $answer)
          <tr>
            <td>{{$answer->question->body}}</td>
            <td>{{$answer->answer_text}}</td>
          </tr>
        @endforeach
       @endforeach
    </tbody>
  </table>
</div>

  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <a href="/adm/docx/survey/{{$attempt->id}}"  class="btn btn-primary">Экспорт</a>
  </div>
</div>