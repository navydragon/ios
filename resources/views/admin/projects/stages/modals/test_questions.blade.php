<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4>Результат ответов на вопрос</h4>
</div>
<div class="modal-body">
      <div class="col-md-12">
        <h4>Вопрос: {{$question->name}}</h4>
        <table class="table table-striped">
          <tr><td><strong>ID вопроса:</strong></td><td>{{$question->id}} </td></tr>
          <tr><td><strong>Количество ответов:</strong></td><td>{{$ta->count()}}</td></tr>
          <tr><td><strong>Количество правильных ответов:</strong></td><td>{{$question->right_answers_in_event($event->id)}}</td></tr>
        </table>
      <hr>
        <h4><strong>Количество ответов участников: </strong></h4>
        @foreach($question->answers as $answer)
          {{$answer->name}}
          @if ($answer->right == 1)
            <span class="text-success">(Правильный)</span>
          @endif
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{round($answer->count_in_event($event->id) * 100 / count($ta))}}%; min-width: 2em;">
              {{$answer->count_in_event($event->id)}} ({{round($answer->count_in_event($event->id) * 100 / count($ta))}} %)
            </div>
          </div>

        @endforeach
      </div>
</div>


  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <button  class="btn btn-primary">Экспорт</button>
  </div>
</div>